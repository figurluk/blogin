<?php

namespace App\Http\Controllers\Admin;

use App\Articles;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
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
        $articles = Articles::all();
        return view('admin.articles.index',compact(['articles']));
    }

    public function today(){
        return view('admin.articles.today');
    }
}
