<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $guarded=['id'];
    public function customer_rank(){
        return $this->belongsTo(CustomerRanking::class,'rank','id');
    }
    public function customer_type(){
        return $this->belongsTo(CustomerTypes::class,'type','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
