<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Http\Request;

class UserObserver
{
    /**
     * Captura evento quando um usuário é criado
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {   
        $request = request();
      
        if($request->has('role_user')){
            $user->rolesByUser()->sync($request->role_user);
        }

        if($request->has('permissions_user')){
            $user->userPermissions()->sync($request->permissions_user);
        }
    }

    /**
     * Captura evento quando um usuário é atualizado
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {

    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {

    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
