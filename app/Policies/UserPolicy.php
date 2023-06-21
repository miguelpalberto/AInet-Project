<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
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
    public function view(User $user, User $userClasse): bool
    {
        //
        return $user->user_type === 'A' || $user->id == $userClasse->id;
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
    public function update(User $user, User $userClasse): bool
    {
        return ($user->id == $userClasse->id) ||
                ($user->user_type === 'A' && $userClasse->user_type !== 'C');//proprio user editar dados ou admin sem ser cliente
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $userClasse): bool
    {
        return $user->user_type === 'A';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $userClasse): bool
    {
        //return $user->user_type === 'A';
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $userClasse): bool
    {
        return false;
    }

    public function changeBlocked(User $user, User $userClasse): bool
    {
        if ($user->user_type !== 'A') {
            return false;
        }
        // Can change "blocked" field, if user is admin
        // but not the logged in user
        return $user->id != $userClasse->id;
    }
}
