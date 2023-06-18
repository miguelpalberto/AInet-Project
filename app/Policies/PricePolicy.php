<?php

namespace App\Policies;

use App\Models\Price;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PricePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    /////ViewAny é para o Index (lista)
    public function viewAny(User $user): bool
    {
        //
        return $user->user_type === 'A';
    }

    /**
     * Determine whether the user can view the model.
     */
    /////ViewAny é para o Show (mostrar só uma)
    public function view(User $user, Price $price): bool
    {
        //
        return $user->user_type === 'A';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return false;
        //return $user->user_type === 'A';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Price $price): bool
    {
        return $user->user_type === 'A';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Price $price): bool
    {
        //return $user->user_type === 'A';
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Price $price): bool
    {
        //return $user->user_type === 'A';
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Price $price): bool
    {
        return false;
    }
}
