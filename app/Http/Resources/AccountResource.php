<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            'account_number'=>$this->account_number,
            'user_id'=>$this->user_id,
            'bank'=>$this->bank,
            'credit_cards'=>$this->creditCards,
            'message'=>'account finded',
            'balance'=>$this->balance
        ];
    }
}
