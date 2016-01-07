<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $admins = User::where('admin',1)->get();
        return view('admin.admins.index',compact(['admins']));
    }

    public function create(){

    }

    public function store(Request $request){

    }

    public function edit($id){

    }

    public function remove($id){

    }

}
