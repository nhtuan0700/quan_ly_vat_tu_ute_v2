<?php

namespace App\Policies;

use App\Models\PhieuDeNghi;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhieuDeNghiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PhieuDeNghi  $phieuDeNghi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, PhieuDeNghi $phieuDeNghi)
    {
        //
    }

    public function view_mua(User $user, PhieuDeNghi $phieuDeNghi)
    {
        return $user->id_donvi === $phieuDeNghi->id_donvi;
    }

    public function view_sua(User $user, PhieuDeNghi $phieuDeNghi)
    {
        return $user->id === $phieuDeNghi->id_creator;
    }

    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PhieuDeNghi  $phieuDeNghi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, PhieuDeNghi $phieuDeNghi)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PhieuDeNghi  $phieuDeNghi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, PhieuDeNghi $phieuDeNghi)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PhieuDeNghi  $phieuDeNghi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, PhieuDeNghi $phieuDeNghi)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PhieuDeNghi  $phieuDeNghi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, PhieuDeNghi $phieuDeNghi)
    {
        //
    }
}
