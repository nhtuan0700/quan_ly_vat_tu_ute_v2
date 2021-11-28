<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmailResetPassword;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserInterface;

class ForgotPasswordController extends Controller
{
    private $userRepo;

    public function __construct(UserInterface $userInterface)
    {
        $this->userRepo = $userInterface;
    }

    public function  showSubmitEmail()
    {
        return view('forgot_password.submit_email');
    }

    public function submitEmail(Request $request)
    {
        $email_exists =  $this->userRepo->where('email', $request->email)->exists();
        if (!$email_exists) {
            return back()->with('alert-fail', 'Không tìm thấy email');
        }
        $code = generateRandomStringNumber();
        $user = $this->userRepo->where('email', $request->email);
        $user->update([
            'code' => Hash::make($code)
        ]);
        $request->session()->flash('email', $request->email);
        SendEmailResetPassword::dispatch($user->first(), $code);
        return redirect(route('forgot_password.submit_code'));
    }

    public function sendCodeAgain(Request $request)
    {
        $code = generateRandomStringNumber();
        try {
            $user = $this->userRepo->where('email', $request->email);
            $user->update([
                'code' => Hash::make($code)
            ]);
            SendEmailResetPassword::dispatch($user->first(), $code);
            $error = false;
        } catch (\Throwable $th) {
            $error = true;
        }
        return response()->json([
            'error' => $error,
        ]);
    }

    public function showSubmitCode()
    {
        if (session()->get('email')) {
            return view('forgot_password.submit_code');
        }
        return redirect(route('forgot_password.submit_email'));
    }

    public function submitCode(Request $request)
    {
        $user = $this->userRepo->where('email', $request->email)->first();
        if (is_null($user)) {
            return redirect(route('forgot_password.submit_email'))
                ->with('alert-fail', 'Không tìm thấy email');
        }
        session()->flash('email', $user->email);
        if (Hash::check($request->code, $user->code)) {
            session()->flash('code', $request->code);
            return redirect(route('forgot_password.reset_password'));
        };
        return redirect(route('forgot_password.submit_code'))->withErrors([
            'code' => 'Mã xác nhận không đúng'
        ]);
    }

    public function showResetPassword()
    {
        if (session()->get('email') && session()->get('code')) {
            return view('forgot_password.reset_password');
        }
        return redirect(route('forgot_password.submit_email'));
    }

    public function resetPassword(Request $request)
    {
        $user = $this->userRepo->where('email', $request->email)->first();
        if (is_null($user)) {
            return redirect(route('forgot_password.submit_email'))
                ->with('alert-fail', 'Không tìm thấy email');
        }
        if (Hash::check($request->code, $user->code)) {
            $this->validate(request(), [
                'password' => [function ($attribute, $value, $fail) use ($user, $request) {
                    if ($value !== request()->password_confirm) {
                        session()->flash('email', $user->email);
                        session()->flash('code', $request->code);
                        $fail('Mật khẩu xác nhận không trùng khớp');
                    }
                }]
            ]);
            $this->userRepo->findOrFail($user->id)->update([
                'password' => Hash::make($request->password)
            ]);
            session()->flash('result', true);
            return redirect(route('forgot_password.result'));
        }
        return redirect(route('forgot_password.submit_email'))
            ->with('alert-fail', 'Mã xác nhận đã hết hiệu lực');
    }

    public function showResult()
    {
        if (session()->get('result')) {
            return view('forgot_password.result');
        }
        return redirect(route('forgot_password.submit_email'));
    }
}
