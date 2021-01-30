<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//         protected $fillable=['id','transfer_type','date','from_account_id','amount','current_balance','title','transfer_date','to_account_id'];
        return [
            'id'=>$this->id,
            'transfer_type'=>$this->transfer_type,
            'date'=>$this->date,
            'amount'=>$this->amount,
            'currency'=>'zł',
            'current_balance'=>$this->current_balance,
            'title'=>$this->title,
            'transfer_date'=>$this->transfer_date,
            'from_account'=>$this->fromAccount->account_number,
            "to_account"=>$this->toAccount->account_number,
            "from_account_id"=>$this->from_account_id,
            "to_account_id"=>$this->to_account_id,
            "form_bank"=>$this->fromAccount->bank,
            "to_bank"=>$this->toAccount->bank,

        ];
    }
}
