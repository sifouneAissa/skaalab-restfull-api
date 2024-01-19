<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected $withToken = false;

    public function setWithToken($withToken= false){
        $this->withToken = $withToken;
        return $this;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email
        ];

        if($this->withToken) $data['token'] = $this->createToken('api-token')->plainTextToken;

        return $data;
    }
}
