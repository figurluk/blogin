<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
                'email.required' => 'Email musí byť vyplnený.',
                'email.email' => 'Email musí byť platna emailová adresa.',
                'email.unique' => 'Zadany email už je registrované.',
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
