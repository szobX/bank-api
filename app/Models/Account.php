<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;


    protected $fillable = ['account_number','user_id','bank_id','date_opened','balance'];
    public  function  bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function creditCards ( ){
        return $this->hasMany(CreditCard::class);
    }
 public function  transactions(){
        return $this->hasMany(Transactions::class);
 }
    public function user(){
        return $this->hasMany(User::class);
    }
    public function setCurrentBalance($id,$amount,$type){
        $account = Account::find($id);
        $currentBalance = 0;
        if($type === 1){
            $currentBalance = floatval($account->balance) - floatval($amount);
        }else{
            $currentBalance = floatval($account->balance) + floatval($amount);
        }

        $account->balance = $currentBalance;
        $account->save();
        return $currentBalance;
    }
    public  function generateNumber($id){
        $fill = '####-####-####-###-#';

//        $bankIdentify-####-####-####-###-#
           $bankIdentify =  Bank::find($id)->identify;
        $sequence = $bankIdentify.'-';
        for ($i = 0; $i < strlen($fill); ++$i) {
            if($fill[$i]==='#'){
                $sequence .= mt_rand(0, 9);
            }else{
                $sequence .='-';
            }
        }
        return $sequence;

    }
}


