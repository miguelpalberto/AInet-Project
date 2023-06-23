<?php

namespace App\Policies;

use App\Models\TshirtImage;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TshirtImagePolicy
{
    //Usado em disciplinas:
    // public function before(?User $user, string $ability): bool|null
    // {
    //     if ((($user->user_type === 'A') ?? false)) {
    //         return true;
    //     }
    //     return null;
    // }
    /**
     * Determine whether the user can view any models.
     */
    /////ViewAny é para o Index (lista)
    public function viewAny(?User $user): bool //?User para anonimos
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    /////ViewAny é para o Show (mostrar só uma)
    public function view(?User $user, TshirtImage $tshirtImage): bool //?User para anonimos
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->user_type === 'A';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TshirtImage $tshirtImage): bool
    {
        return $user->user_type === 'A';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TshirtImage $tshirtImage): bool
    {
        return $user->user_type === 'A';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TshirtImage $tshirtImage): bool
    {
        //return $user->user_type === 'A';
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TshirtImage $tshirtImage): bool
    {
        return false;
    }

    public function createOrderItem(User $user, TshirtImage $tshirtImage): bool
    {
        return true;
    }
}
