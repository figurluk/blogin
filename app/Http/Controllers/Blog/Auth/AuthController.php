<?php

namespace App\Http\Controllers\Blog\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * Class AuthController
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Http\Controllers\Blog\Auth
 */
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
            'name.required'=>'Meno musí byť vyplnené.',
            'name.max'=>'Meno môže mať najviac 255 znakov.',
            'name.string'=>'Meno musí byť postupnosť znakov.',
            'surname.string'=>'Priezvisko musí byť postupnosť znakov.',
            'surname.required'=>'Priezvisko musí byť vyplnené.',
            'surname.max'=>'Priezvisko môže mať najviac 255 znakov.',
            'email.required'=>'Email musí byť vyplnený.',
            'email.email'=>'Email musí byť platná emailová adresa.',
            'email.unique'=>'Zadaný email uz je registrovany.',
            'email.max'=>'Email môže mať najviac 255 znakov.',
            'password.min'=>'Heslo musí mať minimálne 6 znakov.',
            'password.required'=>'Heslo musí byť vyplnené.',
            'password.confirmed'=>'Hesla sa musia zhodovať',
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
