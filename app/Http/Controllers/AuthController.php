<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Models\RoleUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends ApiController
{

    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function storeLogin(LoginRequest $request)
    {
        $check = User::where('email', $request->email)->exists();
        if ($check) {
            $login = Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]);
            if ($login) {
                $user = Auth::user();
                $keyToken = config('app.key_token');
                $tokenResult = $user->createToken($keyToken);
                $token = $tokenResult->token;
                if ($user->remember_me) {
                    $token->expires_at = Carbon::now()->addWeeks(1);
                    $token->save();
                }
                return $this->success('Đăng nhập thành công', $tokenResult->accessToken);
            }
            return $this->show_error('Sai tên tài khoản hoặc mật khẩu, vui lòng đăng nhập lại');
        }
        return $this->show_error('Tài khoản chưa đăng ký. Vui lòng đăng ký hoặc sử dụng tài khoản khác');
    }

    public function storeRegister(RegisterRequest $request)
    {
        $otp = Str::random(6);
        $data_user = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'account_id' => $request->account,
            'password' => Hash::make($request->password),
            'otp' => $otp,
        ];
        $user = $this->user->create($data_user);
        SendEmail::dispatch($user->email, $otp);
        $keyToken = config('app.key_token');
        $tokenResult = $user->createToken($keyToken);
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return $this->success('Tạo tài khoản thành công', $tokenResult->accessToken);
    }
    public function sendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $otp = Str::random(6);
            SendEmail::dispatch($request->email, $otp);
            $user->otp = $otp;
            $user->save();
            return $this->success('Thành công', $request->email);
        }
        return $this->show_error('Email chưa đăng ký. Vui lòng đăng ký hoặc sử dụng Email khác');
    }
    public function checkOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($request->otp == $user->otp) {
            return $this->success('Xác thực thành công', $request->email);
        }
        return $this->show_error('Mã otp không đúng vui lòng kiểm tra lại');
    }
    public function changePassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        return $this->success('Đổi mật khẩu thành công', $user->email);
    }
    public function test()
    {
       
    }
}
