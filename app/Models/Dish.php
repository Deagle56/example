<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Cat;

class Dish extends Model
{
    use HasFactory;
    
    protected  $fillable=[
        'color',
        'cat_id'
    ];
    
    public function cat() 
    {
        return $this->hasOne(Cat::class);
    }
}
