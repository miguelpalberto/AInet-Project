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
        return $user->user_type === 'A';
    }

    /**
     * Determine whether the user can view the model.
     */
    /////ViewAny é para o Show (mostrar só uma)
    public function view(User $user, Order $order): bool
    {
        //
        return $user->user_type === 'A'  || $user->id == $order->id || ($user->user_type === 'E'  && $order->status !== 'canceled' && $order->status !== 'closed');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): bool //?User $user
    {
        //
        //return true;
        return $user !== null && $user->user_type !== 'E';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Order $order): bool
    {
        return $user->user_type === 'A' || $user->user_type === 'E'; //TODO Funcs
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




    public function minhasOrders(User $user): bool
    {
        //return true;
        return $user->user_type === 'C';
    }
    public function minhasOrdersFuncionario(User $user): bool
    {
        return $user->user_type === 'E';
    }




    public function markAsClosed(User $user, Order $order): bool
    {
        return $user->user_type === 'E' || $user->user_type === 'A';
    }
    public function markAsPaid(User $user, Order $order): bool
    {
        return $user->user_type === 'E' || $user->user_type === 'A';
    }
}
