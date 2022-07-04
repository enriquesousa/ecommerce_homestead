<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    // En $user viene almacenado el user que esta log in 
    public function author(User $user, Order $order){

        /*
             Example  │ Name      │ Result                                                    │
            ├──────────┼───────────┼───────────────────────────────────────────────────────────┤
            │$a ==  $b │ Equal     │ TRUE if $a is equal to $b after type juggling.            │
            │$a === $b │ Identical │ TRUE if $a is equal to $b, and they are of the same type. │
        */
        if ($order->user_id === $user->id) {
            return true;
        }else{
            return false;
        }

    }

    // si la orden ya esta pagado no permitir acceso a volverla a pagar 
    public function payment(User $user, Order $order){
        if ($order->status == 2) {
            return false;
        }else{
            return true;
        }
    }

}
