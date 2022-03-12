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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest'); //すでにログインしていたらtopページに行ける
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
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
            'password-confirm' => 'required|string|min:4|same:password',
        ],[
            'username.required' => 'お名前を入力してください。',
            'username.max' => 'お名前は255文字以内で入力してください。',
            'mail.required' => 'E-mailアドレスを入力してください。',
            'password-confirm.same:password' => 'パスワードが違います。',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) //username,mail,passwordをuserテーブルに新規登録している
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
            $data = $request->input(); //データを取得し$dateの箱に入れる

            $validator=$this->validator($data);
            if ($validator->fails()) {
            return redirect('/register')
                        ->withErrors($validator)
                        ->withInput();
                    }
            $this->create($data);
            return redirect('/added')->with('username', $data['username']);
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }

}
