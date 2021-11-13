<?php

namespace App\Policies;

use App\Models\PhieuDeNghi;
use App\Models\User;
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
}
