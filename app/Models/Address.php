<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable=['city','street_and_number','post_code','country'];
    public function user(){
        return $this->hasOne(User::class);
    }
}
