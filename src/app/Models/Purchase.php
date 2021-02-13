<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    public $guarded=['id'];
    public function purchase_items(){

        return $this->hasMany(PurchaseItem::class,'purchase_id','id');
	}
}
