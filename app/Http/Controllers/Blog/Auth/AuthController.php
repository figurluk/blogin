<?php

namespace App\Http\Controllers\Blog\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    protected $redirectPath = '/';
    protected $redirectAfterLogout = '/';

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogin()
    {
        return view('blog.auth.login');
    }

    public function getRegister()
    {
        return view('blog.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|string',
            'surname' => 'required|max:255|string',
            'email' => 'required|email|max:255|unique:users,deleted_at,NULL',
            'password' => 'required|confirmed|min:6',
        ],[
            'name.required'=>'Meno musi byt vyplnene.',
            'name.max'=>'Meno moze mat najviac 255 znakov.',
            'name.string'=>'Meno musi byt postupnost znakov.',
            'surname.string'=>'Priezvisko musi byt postupnost znakov.',
            'surname.required'=>'Priezvisko musi byt vyplnene.',
            'surname.max'=>'Priezvisko moze mat najviac 255 znakov.',
            'email.required'=>'Email musi byt vyplneny.',
            'email.email'=>'Email musi byt platna emailova adresa.',
            'email.unique'=>'Zadany email uz je registrovany.',
            'email.max'=>'Email moze mat najviac 255 znakov.',
            'password.min'=>'Heslo musi mat minimalne 6 znakov.',
            'password.required'=>'Heslo musi byt vyplnene.',
            'password.confirmed'=>'Hesla sa musia zhodovat',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
