<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Transactions extends Model
{
    use HasFactory,FilterQueryString;
    protected $filters = ['transfer_type','from_account_id','amount','title','from_account_id'];

    protected $fillable=['id','transfer_type','date','from_account_id','amount','current_balance','title','transfer_date','to_account_id'];

    public function fromAccount(){
       $fromAccount =  $this->belongsTo(Account::class,'from_account_id');
        return $fromAccount;
    }

    public function toAccount(){
        return $this->belongsTo(Account::class,'to_account_id');
    }

    public static function findForAccount($id){
        $transactions = Transactions::where('from_account_id',$id)->orWhere('to_account_id',$id)->get();
        return $transactions;
}
}
