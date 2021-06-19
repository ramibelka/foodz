<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = ['name', 'Price', 'Photo', 'Ingredients', 'category_id', 'IdRestaurant'];

    protected $hidden = [
        'id', 'created_at','updated_at', 'category_id', 'IdRestaurant'
    ];
}