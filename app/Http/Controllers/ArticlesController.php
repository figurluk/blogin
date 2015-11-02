<?php

namespace App\Http\Controllers;

use App\Articles;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Articles::find($id);
        return view('show',compact(['article']));
    }


}
