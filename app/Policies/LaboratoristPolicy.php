<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Laboratorist;
use Illuminate\Auth\Access\HandlesAuthorization;

class LaboratoristPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return ($user->role_id==1 );
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\odel=Laboratorist  $odel=Laboratorist
     * @return mixed
     */
    public function view(User $user,Laboratorist $laboratorist)
    {
        return ($user->role_id==1 );
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->role_id==1 );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\odel=Laboratorist  $odel=Laboratorist
     * @return mixed
     */
    public function update(User $user,Laboratorist $laboratorist)
    {
        return ($user->role_id==1 || $user->role_id==5);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\odel=Laboratorist  $odel=Laboratorist
     * @return mixed
     */
    public function delete(User $user,Laboratorist $laboratorist)
    {
        return ($user->role_id==1 );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\odel=Laboratorist  $odel=Laboratorist
     * @return mixed
     */
    public function restore(User $user,Laboratorist $laboratorist)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\odel=Laboratorist  $odel=Laboratorist
     * @return mixed
     */
    public function forceDelete(User $user,Laboratorist $laboratorist)
    {
        //
    }
}
