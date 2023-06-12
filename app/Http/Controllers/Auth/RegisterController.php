<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|min:4|max:12',
            'mail' => 'required|string|email|min:4|max:50|unique:users',
            'password' => 'required|string|min:4|max:12|confirmed',
            'password_confirmation' => 'required|string|min:4|max:12'
        ],[
            'username.required' => '名前は必須です',
            'username.min' => '名前は4文字以上です',
            'username.max' => '名前は12文字以下です',
            'mail.required' => 'メールアドレスは必須です',
            'mail.min' => 'メールアドレスは4文字以上です',
            'mail.max' => 'メールアドレスは50文字以下です',
            'mail.email' => '有効なメールアドレスを入力してください',
            'password.required' => 'パスワードは必須です',
            'password.min' => 'パスワードは4文字以上です',
            'password.max' => 'パスワードは12文字以下です',
            'password_confirmation.required' => 'パスワードが一致しません',
            'password_confirmation.min' => 'パスワードが一致しません',
            'password_confirmation.max' => 'パスワードが一致しません',
        ])->validate();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();

            $this->validator($data);
            $this->create($data);
            session()->put('name', $data['username']);
            return redirect('added');
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
