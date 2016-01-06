<?php

namespace App\Http\Controllers;

use App\Articles;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $article = Articles::where('code',$code)->first();
        return view('article.show',compact(['article']));
    }


    public function getImage($code)
    {
        $disk = Storage::disk('local');
        return $disk->get('/articles_img/' . Articles::where('code',$code)->first()->image);
    }

}
