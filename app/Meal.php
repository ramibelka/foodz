<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = ['name', 'Price', 'Photo', 'Ingredients'];

    protected $hidden = [
        'id', 'created_at','updated_at',
    ];
}