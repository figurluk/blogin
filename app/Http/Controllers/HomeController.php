<?php

namespace App\Http\Controllers;

use App\Articles;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Articles::orderBy('created_at')->take(8)->get();
        return view('home.index',compact(['articles']));
    }


}
