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
        'num',
        'count',
        'total_cost',
        'date_closed',
        'waiter_id',
        'is_closed'
    ];
    public function user():BelongsTo
    {
        return $this->BelongsTo(User::class, 'waiter_id', 'id');
    }
    public function dishes():BelongsToMany
    {
        return $this->belongsToMany(Dish::class,'list_of_dishes','orders_id','dishes_id')
            ->withPivot('count');
    }
    public function get_order_number()
    {
        return '#' . str_pad($this->id, 8, "0", STR_PAD_LEFT);
    }
}
