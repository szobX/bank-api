<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
 protected $fillable=['id','transfer_type','date','from_account_id','amount','current_balance','title','transfer_date','to_account_id'];
}
