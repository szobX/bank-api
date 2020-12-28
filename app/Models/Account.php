<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    public  function  bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function creditCards ( ){
        return $this->hasMany(CreditCard::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }
}
