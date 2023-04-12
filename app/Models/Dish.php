<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * @return BelongsTo
     */
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function orders():BelongsToMany
    {
        return $this->belongsToMany(Order::class,'list_of_dishes','dishes_id','orders_id');
    }

}
