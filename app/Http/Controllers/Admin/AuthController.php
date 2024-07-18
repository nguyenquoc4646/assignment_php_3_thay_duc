<?php

namespace App\Http\Controllers\Admin;

use App\Events\ForgotPasswordEvent;
use App\Events\RegisterSuccessEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login_admin()
    {
        if (!empty(Auth::check()) && Auth::user()->is_admin == 1) {
            return redirect('admin/dashboard');
        }
        return view('Admin.Auth.login');
    }

    public function auth_login_admin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1])) {
            return response()->json([
                'status' => true,
                'message' => 'Đăng nhập thành công'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Tài khoản hoặc mật khẩu sai'
            ]);
        }
    }

    public function admin_logout()
    {
        Auth::logout();
        return redirect('admin');
    }

    public function auth_login_client(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (!empty(Auth::user()->email_verified_at)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Đăng nhập thành công'
                ]);
            } else {
                RegisterSuccessEvent::dispatch(Auth::user());
                return response()->json([
                    'status' => false,
                    'message' => 'Vui lòng kiểm tra mail để xác minh tài khoản'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Tài khoản hoặc mật khẩu sai'
            ]);
        }
    }

    public function logout_user()
    {
        Auth::logout();
        return redirect('/');
    }

    public function auth_register_client(Request $request)
    {
        $user = new User;
        $checkEmail = User::checkEmail($request->email);
        if (empty($checkEmail)) {
            if ($request->password == $request->re_password) {
                $user->name = trim($request->name);
                $user->email = trim($request->email);
                $user->password = Hash::make(trim($request->password));

                $user->save();
                RegisterSuccessEvent::dispatch($user);
                return response()->json([
                    'status' => true,
                    'message' => "Đăng kí thành công"
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "Đăng kí lỗi, tài khoản đã tồn tại"
            ]);
        }
    }

    public function activateMail($id)
    {
        $id = base64_decode($id);
        $user = User::find($id);
        $user->email_verified_at =  Carbon::now();
        $user->save();
        return redirect(url(''))->with('success', 'Xác thực thành công');
    }
    public function forgot_password_client(Request $request)
    {
        $checkEmail = User::checkEmail($request->email);
        if (!empty($checkEmail)) {
            $checkEmail->remember_token = Str::random(50);
            $checkEmail->save();
            ForgotPasswordEvent::dispatch($request->email);
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Vui lòng kiểm tra email để đổi mật khẩu'
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Vui lòng kiểm tra email để đổi mật khẩu'
                ]
            );
        }
    }

    public function reset_password($token)
    {
        return view('Clients.Reset-password', ['token' => $token]);
    }
    public function update_password(Request $request)
    {
        $user = User::where('remember_token', $request->remember_token)->first();
        if (!empty($user)) {
            if ($request->password == $request->confirm_password) {
                $user->password = Hash::make(trim($request->password));
                $user->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Đối mật khẩu thành công, vui lòng đăng nhập lại'
                ]);
            }
        } 
    }
}
