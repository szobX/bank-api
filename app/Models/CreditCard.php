<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;
    protected $fillable =  ['type','exp_date','number','cvv','account_id','active','limit_per_day'];

    public function account(){
        return $this->belongsTo(Account::class);
    }
    public function generateCvv(){
        $cvv = rand(100,999);
        return $cvv;
    }
    public  function generateNumber(){
//        ####-####-####-####
        $fill = '####-####-####-####';
        $sequence = '';
        for ($i = 0; $i < strlen($fill); ++$i) {
            if($fill[$i]==='#'){
                $sequence .= mt_rand(0, 9);
            }else{
                $sequence .='-';
            }
        }
        return $sequence;

    }
    public static function withFilters($id,$filters){
        $query = CreditCard::query();
        if(isset($filters['active'])){
            $query->where('active',$filters['active']);
        }

        if(isset($filters['type'])){
            $value = '%'.$filters['type'].'%';
            $query->where('type', 'like', $value);
        }
        if(isset($filters['balance'])){
            $value = $filters['balance'];
            $query->where('balance', '>=', $value);
        }
        if($id){
            $query->where(function($query)use($id){
                $query->where('account_id', $id)
                    ->orWhere('account_id', $id);
            });
        }
//                dd($query->toSql());
        return $query->get();

    }
}
