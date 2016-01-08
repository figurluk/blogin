<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateUserRequest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id','!=',Auth::user()->id)->where('admin',0)->paginate(10);
        return view('admin.users.index',compact(['users']));
    }

    public function today(){
        return view('admin.users.today');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(CreateUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $pass = $this->generateRandomString(6);
        $user->password = bcrypt($pass);
        $user->save();

        Mail::send('admin.emails.create_user', ['user' => $user,'pass'=>$pass], function ($m) use ($user) {
            $m->from('blogblogin@gmail.com', 'Blogin Administrátor');
            $m->to($user->email, $user->name)->subject('Boli ste zaregistrovaný do Blogin.');
        });

        flash()->info('Úspešne ste vytvorili užívateľa: ' . $user->name . '. Heslo mu bolo odoslané na email.');
        if (isset($request->save))
            return redirect()->action('Admin\UsersController@edit', $user->id);
        else {
            return redirect()->action('Admin\UsersController@index');
        }

    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.user.show', compact(['user']));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if ($user->email != $request->email) {
            $this->validate($request, [
                'email' => 'required|email|max:255|unique:users,deleted_at,NULL',
            ], [
                'email.required' => 'Email musí byt vyplnený.',
                'email.email' => 'Email musí byť platná emailová adresa.',
                'email.unique' => 'Zadaný email už je registrovaný.',
                'email.max' => 'Email môže mať najviac 255 znakov.',
            ]);
        }
        if ($request->newpassword != "") {
            $this->validate($request, [
                'newpassword' => 'required|confirmed|min:6',
            ], [
                'newpassword.min' => 'Heslo musí mať minimálne 6 znakov.',
                'newpassword.required' => 'Heslo musí byť vyplnené.',
                'newpassword.confirmed' => 'Heslá sa musia zhodovať',
            ]);
            $user->password = bcrypt($request->newpassword);
        }
        $this->validate($request, [
            'name' => 'required|max:255|string',
            'surname' => 'required|max:255|string',
        ], [
            'name.required' => 'Meno musí byť vyplnené.',
            'name.max' => 'Meno môže mať najviac 255 znakov.',
            'name.string' => 'Meno musí byť postupnosť znakov.',
            'surname.string' => 'Priezvisko musí byť postupnosť znakov.',
            'surname.required' => 'Priezvisko musí byť vyplnené.',
            'surname.max' => 'Priezvisko môže mať najviac 255 znakov.',
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->save();

        flash()->info('Úspešne ste upravili Vas profil.');
        return view('admin.user.show', compact(['user']));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact(['user']));
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        if ($user->email != $request->email) {
            $this->validate($request, [
                'email' => 'required|email|max:255|unique:users,deleted_at,NULL',
            ], [
                'email.required' => 'Email musí byt vyplnený.',
                'email.email' => 'Email musí byť platná emailová adresa.',
                'email.unique' => 'Zadaný email už je registrovaný.',
                'email.max' => 'Email môže mať najviac 255 znakov.',
            ]);
        }
        if ($request->password) {
            $pass = $this->generateRandomString(6);
            $user->password = bcrypt($pass);
            Mail::send('admin.emails.pass_user', ['user' => $user,'pass'=>$pass], function ($m) use ($user) {
                $m->from('blogblogin@gmail.com', 'Blogin Administrátor');
                $m->to($user->email, $user->name)->subject('Bolo vám vygenerované nové heslo administrátorom.');
            });
        }
        $this->validate($request, [
            'name' => 'required|max:255|string',
            'surname' => 'required|max:255|string',
        ], [
            'name.required' => 'Meno musí byť vyplnené.',
            'name.max' => 'Meno môže mať najviac 255 znakov.',
            'name.string' => 'Meno musí byť postupnosť znakov.',
            'surname.string' => 'Priezvisko musí byť postupnosť znakov.',
            'surname.required' => 'Priezvisko musí byť vyplnené.',
            'surname.max' => 'Priezvisko môže mať najviac 255 znakov.',
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->save();

        flash()->info('Úspešne ste upravili užívateľa: ' . $user->name);
        if (isset($request->update))
            return redirect()->action('Admin\UsersController@edit', $user->id);
        else {
            return redirect()->action('Admin\UsersController@index');
        }
    }

    public function remove($id)
    {
        $user = User::find($id);
        flash()->info('Úspešne ste zmazali užívateľa: ' . $user->name);
        $user->delete();
        return redirect()->action('Admin\UsersController@index');
    }

    private function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
