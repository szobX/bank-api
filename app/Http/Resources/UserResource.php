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
//        "id": 4,
//      "name": "Ms. Annie Quigley",
//      "email": "efritsch@example.com",
//      "email_verified_at": "2021-01-09T14:53:47.000000Z",
//      "phone": "1-346-923-1097",
//      "birthday": "1990-11-28 17:25:47",
//      "sex": "0",
//      "first_name": "Domenick",
//      "last_name": "Osinski",
//      "address_id": 10,
        return [
            'id'=>$this->id,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'sex'=>$this->sex,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'address_id'=>$this->adress_id,
            'address'=>$this->address,
            'birthday'=>$this->birthday,
        ];
    }
}
