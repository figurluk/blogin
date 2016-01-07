<?php

namespace App\Http\Controllers\Admin;

use App\Comments;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
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
        $comments = Comments::all();
        return view('admin.comments.index',compact(['comments']));
    }

    public function today(){
        return view('admin.comments.today');
    }
}
