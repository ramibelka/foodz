<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function categories()
    {
        return $this->hasMany('App\Meal');
    }

    protected $hidden = [
        'id', 'created_at','updated_at',
    ];
}
