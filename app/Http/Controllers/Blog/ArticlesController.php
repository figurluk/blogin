<?php

namespace App\Http\Controllers\Blog;

use App\Articles;
use App\Comments;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

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
        return view('blog.article.show', compact(['article', 'code']));
    }

    public function comment($code, Request $request)
    {
        $comment = Comments::create([
            'content' => trim($request->cont, " \t"),
        ]);
        $article = Articles::where('code', $code)->first();
        $article->comments()->save($comment);
        Auth::user()->comments()->save($comment);

        if ($request->comment != 0) {
            $comm = Comments::find($request->comment);
            $comm->comments()->save($comment);
        }
        if ($request->ajax()) {
            $view = View::make('blog.article.show', compact(['article', 'code']));
            $sections = $view->renderSections();
            return response(array("content" => $sections['content']));
        } else {
            $this->validate($request, [
                'cont' => 'required'
            ], [
                'cont.required' => 'Obsah komentaru nemoze byt prazdny!'
            ]);
            flash()->info('Uspesne ste komentovali clanok.');
            return view('blog.article.show', compact(['article', 'code']));
        }
    }


    public function getImage($code)
    {
        $disk = Storage::disk('local');
        if ($code == "default")
            return $disk->get('/articles_img/default.png');
        else
            return $disk->get('/articles_img/' . Articles::where('code', $code)->first()->image);
    }

}
