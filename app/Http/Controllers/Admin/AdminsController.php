<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateAdminRequest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/**
 * Class AdminsController
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Http\Controllers\Admin
 */
class AdminsController extends Controller
{
    /**
     * AdminController constructor.
     * @author Lukas Figura <figurluk@gmail.com>
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }


    /**
     * Display a list of admins.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('admin', 1)->paginate(10);
        return view('admin.admins.index', compact(['admins']));
    }

    /**
     * Display view for creating new Admin
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Metod hande POST request to create new Admin.
     *
     * @param CreateAdminRequest $request
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAdminRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->admin = 1;
        $user->email = $request->email;
        $user->notification = $request->notification;
        $pass = $this->generateRandomString(6);
        $user->password = bcrypt($pass);
        $user->save();

        Mail::send('admin.emails.create_admin', ['user' => $user, 'pass' => $pass], function ($m) use ($user) {
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

    /**
     * Display Admin details
     *
     * @param int $id id of displayed Admin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Lukas Figura <figurluk@gmail.com>
     */
    public function edit($id)
    {
        $admin = User::find($id);
        return view('admin.admins.edit', compact(['admin']));
    }

    /**
     * Method handle POST request to update Admin
     *
     * @param int $id id of Admin which will be updated
     * @param Request $request
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $user = User::find($id);
        $pass = "";
        if ($user->email != $request->email) {
            $this->validate($request, [
                'email' => 'required|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            ], [
                'email.required' => 'Email musí byt vyplnený.',
                'email.email' => 'Email musí byť platná emailová adresa.',
                'email.unique' => 'Zadaný email už je registrovaný.',
                'email.max' => 'Email môže mať najviac 255 znakov.',
            ]);
        }
        if ($user->id == Auth::user()->id && $request->newpassword != '') {
            if (!Hash::check($request->newpassword, $user->password)) {
                $request->flash();
                return redirect()->back()->withInput()->withErrors(['password' => 'Staré heslo nie je správne.']);
            }
            $this->validate($request, [
                'newpassword' => 'required|confirmed|min:6',
            ], [
                'newpassword.min' => 'Heslo musí mať minimálne 6 znakov.',
                'newpassword.required' => 'Heslo musí byť vyplnené.',
                'newpassword.confirmed' => 'Heslá sa musia zhodovať',
            ]);
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


        if ($user->id == Auth::user()->id && $request->newpassword != '') {
            $user->password = bcrypt($request->newpassword);
        } elseif ($request->newpass) {
            $pass = $this->generateRandomString(6);
            $user->password = bcrypt($pass);
        }

        $user->name = $request->name;
        $user->admin = 1;
        $user->surname = $request->surname;
        $user->notification = $request->notification;
        $user->email = $request->email;
        if ($user->id == Auth::user()->id && $request->password != '') {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        if ($request->newpass) {
            Mail::send('admin.emails.pass_user', ['user' => $user, 'pass' => $pass], function ($m) use ($user) {
                $m->from('blogin@weebto.me', 'Blogin Administrátor');
                $m->to($user->email, $user->name)->subject('Bolo vám vygenerované nové heslo administrátorom.');
            });
        }

        flash()->info('Úspešne ste upravili administrátora: ' . $user->name);
        if (isset($request->update))
            return redirect()->action('Admin\AdminsController@edit', $user->id);
        else {
            return redirect()->action('Admin\AdminsController@index');
        }
    }

    /**
     * Method removes Admin
     *
     * @param int $id id of Admin which will be removed
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        $user = User::find($id);
        flash()->info('Úspešne ste zmazali tag: ' . $user->name);
        $user->delete();
        return redirect()->action('Admin\AdminsController@index');
    }

    /**
     * Method generate random string
     *
     * @param int $length length of generated string
     * @author Lukas Figura <figurluk@gmail.com>
     * @return string
     */
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
