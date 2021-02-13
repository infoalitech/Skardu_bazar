<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRanking extends Model
{
    use HasFactory;
    public $guarded=['id'];

    public function customers(){
        return $this->haMany(Customer::class,'rank','id');
    }
}
