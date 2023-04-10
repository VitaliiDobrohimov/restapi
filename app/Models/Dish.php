<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    use Filterable;
    protected $table = 'dishes';
    protected $fillable = [
        'name',
        'image',
        'composition',
        'calories',
        'category_id',
        'cost'
    ];
}
