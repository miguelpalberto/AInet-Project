<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    /////ViewAny é para o Index (lista)
    public function viewAny(User $user): bool
    {
        //
        return $user->user_type === 'A' || $user->user_type === 'E'; //TODO Funcs nao verem canceladas
    }

    /**
     * Determine whether the user can view the model.
     */
    /////ViewAny é para o Show (mostrar só uma)
    public function view(User $user, Order $order): bool
    {
        //
        return $user->user_type === 'A'  || $user->id == $order->id || ($user->user_type === 'E'  && $order->status !== 'canceled');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): bool //?User $user
    {
        //
        //return true;
        return $user !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Order $order): bool
    {
        return $user->user_type === 'A' || $user->user_type === 'E';//TODO Funcs
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Order $order): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Order $order): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Order $order): bool
    {
        return false;
    }
}
