<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use Filterable;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'image'
    ];
    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class, 'category_id', 'id');
    }
}
