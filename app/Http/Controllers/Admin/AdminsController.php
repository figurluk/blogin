<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateAdminRequest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminsController extends Controller
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
        $admins = User::where('admin', 1)->paginate(10);
        return view('admin.admins.index', compact(['admins']));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(CreateAdminRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->admin = 1;
        $user->email = $request->email;
        $pass = $this->generateRandomString(6);
        $user->password = bcrypt($pass);
        $user->save();

        Mail::send('admin.emails.create_admin', ['user' => $user,'pass'=>$pass], function ($m) use ($user) {
            $m->from('blogin@weebto.me', 'Blogin Administrátor');
            $m->to($user->email, $user->name)->subject('Boli ste zaregistrovaný ako administrátor.');
        });

        flash()->info('Úspešne ste vytvorili administrátora: ' . $user->name . '. Heslo mu bolo odoslané na email.');
        if (isset($request->save))
            return redirect()->action('Admin\AdminsController@edit', $user->id);
        else {
            return redirect()->action('Admin\AdminsController@index');
        }

    }

    public function edit($id)
    {
        $admin = User::find($id);
        return view('admin.admins.edit', compact(['admin']));
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
        if ($user->id == Auth::user()->id && $request->password!='') {
            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ], [
                'password.min'=>'Heslo musí mať minimálne 6 znakov.',
                'password.required'=>'Heslo musí byť vyplnené.',
                'password.confirmed'=>'Heslá sa musia zhodovať',
            ]);
        }
        elseif($request->newpass) {
            $pass = $this->generateRandomString(6);
            $user->password = bcrypt($pass);
            Mail::send('admin.emails.pass_user', ['user' => $user,'pass'=>$pass], function ($m) use ($user) {
                $m->from('blogin@weebto.me', 'Blogin Administrátor');
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
        $user->admin = 1;
        $user->surname = $request->surname;
        $user->email = $request->email;
        if ($user->id == Auth::user()->id && $request->password!='') {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        flash()->info('Úspešne ste upravili administrátora: ' . $user->name);
        if (isset($request->update))
            return redirect()->action('Admin\AdminsController@edit', $user->id);
        else {
            return redirect()->action('Admin\AdminsController@index');
        }
    }

    public function remove($id)
    {
        $user = User::find($id);
        flash()->info('Úspešne ste zmazali tag: ' . $user->name);
        $user->delete();
        return redirect()->action('Admin\AdminsController@index');
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
