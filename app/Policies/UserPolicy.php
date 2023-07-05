<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super-admin', 'admin']) || $user->hasAnyPermission(['read user']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->hasAnyRole(['super-admin', 'admin']) || $user->hasAnyPermission(['read user']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['super-admin', 'admin']) || $user->hasAnyPermission(['create user']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Model $model): bool
    {
        if($model->hasAnyRole(['super-admin']) && !$user->hasPermissionTo('update admin')) {
            return false;
        }
        return $user->hasAnyRole(['super-admin']) || $user->hasAnyPermission(['update user']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Model $model): bool
    {
        if($model->hasAnyRole(['super-admin'])){
            return false;
        }
        return $user->hasAnyRole(['super-admin']) || $user->hasAnyPermission(['delete user']);
    }
}
