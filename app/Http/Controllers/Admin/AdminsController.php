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
        $user->email = $request->email;
        $pass = $this->generateRandomString(6);
        $user->password = bcrypt($pass);
        $user->save();

        Mail::send('admin.emails.create_admin', ['user' => $user,'pass'=>$pass], function ($m) use ($user) {
            $m->from('figurluk@gmail.com', 'Blogin Administrator');
            $m->to($user->email, $user->name)->subject('Boli ste zaregistrovany ako administrator.');
        });

        flash()->info('Uspesne ste vytvorili administratora: ' . $user->name . '. Heslo mu bolo odoslane na email.');
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
                'email.required'=>'Email musi byt vyplneny.',
                'email.email'=>'Email musi byt platna emailova adresa.',
                'email.unique'=>'Zadany email uz je registrovany.',
                'email.max'=>'Email moze mat najviac 255 znakov.',
            ]);
        }
        if ($user->id == Auth::user()->id && $request->password!='') {
            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ], [
                'password.min'=>'Heslo musi mat minimalne 6 znakov.',
                'password.required'=>'Heslo musi byt vyplnene.',
                'password.confirmed'=>'Hesla sa musia zhodovat',
            ]);
        }
        $this->validate($request, [
            'name' => 'required|max:255|string',
            'surname' => 'required|max:255|string',
        ], [
            'name.required'=>'Meno musi byt vyplnene.',
            'name.max'=>'Meno moze mat najviac 255 znakov.',
            'name.string'=>'Meno musi byt postupnost znakov.',
            'surname.string'=>'Priezvisko musi byt postupnost znakov.',
            'surname.required'=>'Priezvisko musi byt vyplnene.',
            'surname.max'=>'Priezvisko moze mat najviac 255 znakov.',
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        if ($user->id == Auth::user()->id && $request->password!='') {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        flash()->info('Uspesne ste upravili administratora: ' . $user->name);
        if (isset($request->update))
            return redirect()->action('Admin\AdminsController@edit', $user->id);
        else {
            return redirect()->action('Admin\AdminsController@index');
        }
    }

    public function remove($id)
    {
        $user = User::find($id);
        flash()->info('Uspesne ste zmazali tag: ' . $user->name);
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
