<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function edit()
    {
        $user = Auth::user();
        return view('blog.user.show', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if ($user->email != $request->email) {
            $this->validate($request, [
                'email' => 'required|email|max:255|unique:users,deleted_at,NULL',
            ], [
                'email.required' => 'Email musi byt vyplneny.',
                'email.email' => 'Email musi byt platna emailova adresa.',
                'email.unique' => 'Zadany email uz je registrovany.',
                'email.max' => 'Email moze mat najviac 255 znakov.',
            ]);
        }
        if ($request->newpassword != "") {
            $this->validate($request, [
                'newpassword' => 'required|confirmed|min:6',
            ], [
                'newpassword.min' => 'Heslo musi mat minimalne 6 znakov.',
                'newpassword.required' => 'Heslo musi byt vyplnene.',
                'newpassword.confirmed' => 'Hesla sa musia zhodovat',
            ]);
            $user->password = bcrypt($request->newpassword);
        }
        $this->validate($request, [
            'name' => 'required|max:255|string',
            'surname' => 'required|max:255|string',
        ], [
            'name.required' => 'Meno musi byt vyplnene.',
            'name.max' => 'Meno moze mat najviac 255 znakov.',
            'name.string' => 'Meno musi byt postupnost znakov.',
            'surname.string' => 'Priezvisko musi byt postupnost znakov.',
            'surname.required' => 'Priezvisko musi byt vyplnene.',
            'surname.max' => 'Priezvisko moze mat najviac 255 znakov.',
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->save();

        flash()->info('Uspesne ste upravili Vas profil.');
        return redirect()->action('Blog\UserController@edit');

    }

}
