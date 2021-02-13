<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTypes extends Model
{
    use HasFactory;
    public $guarded=['id'];

    public function customers(){
        return $this->haMany(Customer::class,'type','id');
    }
}
