<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'firstName'=>$this->first_name,
            'lastName'=>$this->last_name,
            'sex'=>$this->sex,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'addressId'=>$this->adress_id,
            'address'=>$this->address,
            'birthday'=>$this->birthday,
            'accounts'=>  AccountResource::collection($this->accounts),
        ];
    }
}
