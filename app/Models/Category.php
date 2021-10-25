<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'category_name',
    ];

    //Here this function to join user table with category table by id and user_id and return one user by hasOne() function
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
