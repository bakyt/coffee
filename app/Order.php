<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'waiter_id',
        'table_id',
        'isOpen',
        'total'
    ];
}
