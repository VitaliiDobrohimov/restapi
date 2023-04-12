<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class  Order extends Model
{
    use HasFactory;
    use Filterable;
    protected $table = 'orders';
    protected $fillable = [
        'number',
        'count',
        'total_cost',
        'date_closed',
        'waiter_id',
    ];
    public function user():BelongsTo
    {
        return $this->BelongsTo(User::class, 'waiter_id', 'id');
    }
    public function dishes():BelongsToMany
    {
        return $this->belongsToMany(Dish::class,'list_of_dishes','orders_id','dishes_id');
    }
}
