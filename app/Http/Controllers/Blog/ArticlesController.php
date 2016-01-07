<?php

namespace App\Http\Controllers\Blog;

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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $article = Articles::where('code', $code)->first();
        return view('blog.article.show', compact(['article']));
    }


    public function getImage($code)
    {
        $disk = Storage::disk('local');
        if ($code = "default")
            return $disk->get('/articles_img/default.png');
        else
            return $disk->get('/articles_img/' . Articles::where('code', $code)->first()->image);
    }

}
