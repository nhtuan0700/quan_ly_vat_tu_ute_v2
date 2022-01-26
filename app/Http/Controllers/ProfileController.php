<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UpdateInfo;
use App\Repositories\User\UserInterface;
use App\Http\Requests\User\UpdatePassword;

class ProfileController extends Controller
{
    private $userRepo;

    public function __construct(UserInterface $userInterface)
    {
        $this->userRepo = $userInterface;
    }

    public function showInfo()
    {
        $user = auth()->user();
        return view('profile.info', compact('user'));
    }

    public function updateInfo(UpdateInfo $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $this->userRepo->update(auth()->id(), $data);
        return back()->with('alert-success', trans('Cập nhật thông tin thành công'));
    }

    public function showFormChangPassword()
    {
        return view('profile.change_password');
    }

    public function updatePassword(UpdatePassword $request)
    {
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }
        $data['password'] = Hash::make($request->password);
        $this->userRepo->update(auth()->id(), $data);
        return redirect(route('profile.info'))->with('alert-success', 'Đổi mật khẩu thành công');
    }
}
