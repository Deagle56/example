<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dish;




class Cat extends Model
{
    

    use HasFactory;
    protected  $fillable=[
        'name',
        'gender',
        'dish_id',
        'color'

    ];

    public function dishes() 
    {
        return $this->hasOne(Dish::class);
    }
    public function toys() 
    {
        return $this->hasMany(Toy::class);
    }
}
