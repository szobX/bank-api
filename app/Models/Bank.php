<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    public function account(){
        return $this->hasMany(Account::class);
    }
    public function  randomIdentify(){
        return Bank::all()->random()->identify;
    }
}
