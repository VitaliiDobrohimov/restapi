<?php

namespace App\Policies;


use App\Models\User;



class DishPolicy
{

    public function viewAny(User $user): bool
    {
        //dd(11);
        //return in_array($user['role_id'],[1,2,3]);
    }

    public function view(User $user): bool
    {
       // return $model->role_id === [1,2,3];
        return in_array($user['role_id'],[1,2]);
    }



    public function create(User $user): bool
    {
        return in_array($user->role_id,[1,2]);
    }


    public function update(User $user, User $model): bool
    {

        return in_array($user->role_id,[1,2]);
    }


    public function delete(User $user, User $model): bool
    {
        return in_array($user->role_id,[1,2]);
    }






}
