<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //dd(11);
        //return in_array($user['role_id'],[1,2,3]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
       // return $model->role_id === [1,2,3];

        return in_array($user->role()->first()->name,[Role::IS_SUPERADMIN,Role::IS_ADMIN]);
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role()->first()->name,[Role::IS_SUPERADMIN,Role::IS_ADMIN]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return in_array($user->role()->first()->name,[Role::IS_SUPERADMIN,Role::IS_ADMIN]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return in_array($user->role()->first()->name,[Role::IS_SUPERADMIN,Role::IS_ADMIN]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
    }



}
