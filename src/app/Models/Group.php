<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public $guarded=['id'];
    public function users(){

        return $this->belongsToMany(User::class,'user_groups','group_id','user_id');
    }
    public function permissions(){

        return $this->belongsToMany(Permission::class,'group_permissions','group_id','permission_id');
    }

}
