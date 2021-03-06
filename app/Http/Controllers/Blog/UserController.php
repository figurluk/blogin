<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Http\Controllers\Blog
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display User details which is logged to Blogin
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('blog.user.show', compact(['user']));
    }

    /**
     * Method handle POST request for update logged User to Blogin
     *
     * @param Request $request
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if ($user->email != $request->email) {
            $this->validate($request, [
                'email' => 'required|email|max:255|unique:users,deleted_at,NULL',
            ], [
                'email.required' => 'Email musí byť vyplnený.',
                'email.email' => 'Email musí byť platna emailová adresa.',
                'email.unique' => 'Zadany email už je registrované.',
                'email.max' => 'Email môže mať najviac 255 znakov.',
            ]);
        }
        if ($request->newpassword != "") {
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
            $user->password = bcrypt($request->newpassword);
        }
        $this->validate($request, [
            'name' => 'required|max:255|string',
            'surname' => 'required|max:255|string',
        ], [
            'name.required' => 'Meno musí byt vyplnené.',
            'name.max' => 'Meno môže mať najviac 255 znakov.',
            'name.string' => 'Meno musí byť postupnosť znakov.',
            'surname.string' => 'Priezvisko musí byť postupnosť znakov.',
            'surname.required' => 'Priezvisko musí byť vyplnené.',
            'surname.max' => 'Priezvisko môže mať najviac 255 znakov.',
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->notification = $request->notification;
        $user->save();

        flash()->info('Úspešne ste upravili Váš profil.');
        return redirect()->action('Blog\UserController@edit');

    }

}
