<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
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
}
