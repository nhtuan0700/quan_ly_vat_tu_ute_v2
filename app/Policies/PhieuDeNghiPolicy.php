<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Models\PhieuDeNghi;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhieuDeNghiPolicy
{
    use HandlesAuthorization;

    public function view_mua(User $user, PhieuDeNghi $phieuDeNghi)
    {
        return $user->id_donvi === $phieuDeNghi->id_donvi;
    }

    public function view_sua(User $user, PhieuDeNghi $phieuDeNghi)
    {
        return $user->id === $phieuDeNghi->id_creator;
    }

    public function update_sua(User $user, PhieuDeNghi $phieuDeNghi)
    {
        return $user->id === $phieuDeNghi->id_creator &&
            $phieuDeNghi->status == PhieuDeNghi::CONFIRMING &&
            !$phieuDeNghi->is_mua;
    }

    public function delete_sua(User $user, PhieuDeNghi $phieuDeNghi)
    {
        return $user->id === $phieuDeNghi->id_creator &&
            $phieuDeNghi->status == PhieuDeNghi::CONFIRMING &&
            !$phieuDeNghi->is_mua;
    }

    public function confirm(User $user, PhieuDeNghi $phieuDeNghi)
    {
        return $phieuDeNghi->status == PhieuDeNghi::CONFIRMING &&
            $user->id_role == Role::CSVC;
    }

    public function update_detail_sua(User $user, PhieuDeNghi $phieuDeNghi)
    {
        return $phieuDeNghi->status == PhieuDeNghi::CONFIRMED &&
            $user->id_role == Role::CSVC;
    }
}
