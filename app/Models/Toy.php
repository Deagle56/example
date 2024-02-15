<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cat;

class Toy extends Model
{
    use HasFactory;

    protected  $fillable=[
        'color',
        'cat_id'
    ];

    public function cat() 
    {
        return $this->belongsTo(Cat::class);
    }
}
