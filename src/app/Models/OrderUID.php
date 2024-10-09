<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderUID extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'currency',
    ];

    protected $table = 'orders_uid';

    public $timestamps = false;
}
