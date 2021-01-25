<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'sex',
        'phone',
        'birthday',
        'address_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function accounts(){
        return $this->hasMany(Account::class);

    }
    public function address(){
        return $this->belongsTo(Address::class);
    }

    public static function withFilters($filters){
        $query = User::query();


        if(isset($filters['sex'])){
            $query->where('sex',$filters['sex']);
        }
        if(isset($filters['email'])){
            $value = '%'.$filters['email'].'%';

            $query->where('email','like',$value);
        }
        if(isset($filters['search'])){
            $value = '%'.$filters['search'].'%';
            $query->where(function($query)use($value){
                $query->where('first_name', 'like' ,$value)
                    ->orWhere('last_name', 'like' ,$value);
            });

        }
        if(isset($filters['lastName'])){
            $value = '%'.$filters['lastName'].'%';
            $query->where('last_name', 'like', $value);
        }

//                dd($query->toSql());
        return $query->get();

    }

}
