<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Book\BookCollectionResource;
use App\Http\Resources\Book\BookResource;
use App\Models\Book;
use App\Rules\ISBNRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    //

    public function index(Request $request){
        return $this->setResult(true,BookCollectionResource::make(Book::all()));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:1|max:500',
            'author' => 'required|min:1|max:500',
            'publication_year' => 'required|numeric|digits:4|integer|min:1900|max:' . (date('Y') + 10),
            'isbn' => ['required',new ISBNRule()]
        ]);

        if($validator->fails()) return $this->setResult(false,$validator->errors(),'errors',401);

        $nbook = Book::query()->create($validator->validated());

        return $this->setResult(true,BookResource::make($nbook));
    }

    public function update(Request $request,Book $book){

        $validator = Validator::make($request->all(),[
            'title' => 'required|max:500',
            'author' => 'required|max:500',
            'publication_year' => 'required|numeric|digits:4|integer|min:1900|max:' . (date('Y') + 10),
            'isbn' => ['required',new ISBNRule()]
        ]);

        if($validator->fails()) return $this->setResult(false,$validator->errors(),'errors',401);


        $status = $book->update($validator->validated());

        return $this->setResult($status,BookResource::make($book));
    }

    public function show(Request $request,Book $book){
        return $this->setResult(true,BookResource::make($book));
    }

    public function destroy(Request $request,Book $book){
        return $this->setResult($book->delete(),"Record deleted");
    }


    public function setResult($success = true,$message = 'Data invalid',$key='data',$status = 200){
        return response()->json([
            'success' => $success,
            $key => $message
        ],$status);
    }

}
