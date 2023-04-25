<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';

    public const IS_SUPERADMIN = "superAdmin";
    public const IS_ADMIN = "Admin";
    public const IS_WAITER = "waiter";

    protected $fillable = [
        'name',
        'role_id'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
