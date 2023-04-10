<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class List_of_dishes extends Model
{
    use HasFactory;
    protected $table = 'list_of_dishes';
    protected $fillable = [
        'orders_id',
        'count',
        'dishes_id'
    ];
}
