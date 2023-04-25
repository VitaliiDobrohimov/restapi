<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class CategoryPolicy
{

    public function viewAny(User $user): bool
    {
        //dd(11);
        //return in_array($user['role_id'],[1,2,3]);
    }

    public function view(User $user): bool
    {
       // return $model->role_id === [1,2,3];
        return in_array($user->role()->first()->name,[Role::IS_SUPERADMIN,Role::IS_ADMIN,Role::IS_WAITER]);
    }



    public function create(User $user): bool
    {
        return in_array($user->role()->first()->name,[Role::IS_SUPERADMIN,Role::IS_ADMIN]);
    }


    public function update(User $user): bool
    {

        return in_array($user->role()->first()->name,[Role::IS_SUPERADMIN,Role::IS_ADMIN]);
    }


    public function delete(User $user): bool
    {
        return in_array($user->role()->first()->name,[Role::IS_SUPERADMIN,Role::IS_ADMIN]);
    }






}
