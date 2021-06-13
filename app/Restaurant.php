<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'Address', 'Photo'];

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    protected $hidden = [
        'id', 'created_at','updated_at',
    ];	
}
