<?php

namespace App\Policies;

use App\Models\Color;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ColorPolicy
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
    public function view(User $user, Color $color): bool
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
        //return true;
        return $user->user_type === 'A';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Color $color): bool
    {
        return $user->user_type === 'A';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Color $color): bool
    {
        return $user->user_type === 'A';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Color $color): bool
    {
        //return $user->user_type === 'A';
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Color $color): bool
    {
        return false;
    }
}
