<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['state', 'Delivery Address', 'Payment Method', 'Position'];

    protected $hidden = [
        'id', 'created_at','updated_at',
    ];
}

