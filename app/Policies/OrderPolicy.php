<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {

        return in_array($user->role()->first()->name,[Role::IS_SUPERADMIN,Role::IS_ADMIN,Role::IS_WAITER]);
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role()->first()->name,[Role::IS_SUPERADMIN,Role::IS_ADMIN,Role::IS_WAITER]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {

        //return $user->id === $model->waiter_id;
        return in_array($user->role()->first()->name,[Role::IS_SUPERADMIN,Role::IS_ADMIN,Role::IS_WAITER]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return in_array($user->role()->first()->name,[Role::IS_SUPERADMIN,Role::IS_ADMIN,Role::IS_WAITER]);
    }





}
