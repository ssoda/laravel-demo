<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderUSD extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'city',
        'district',
        'street',
        'price',
    ];

    protected $table = 'orders_usd';

    public $timestamps = false;
}
