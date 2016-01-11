<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App\Http\Controllers\Blog;

use App\Articles;
use App\Comments;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

/**
 * Class ArticlesController
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Http\Controllers\Blog
 */
class ArticlesController extends Controller
{

    /**
     * Display an Article
     *
     * @param string $code code of Article which will be showed
     * @author Lukas Figura <figurluk@gmail.com>
     * @return View
     */
    public function show($code)
    {
        $article = Articles::where('code', $code)->first();
        return view('blog.article.show', compact(['article', 'code']));
    }

    /**
     * Method handle POST request to like Article
     *
     * @param string $code code of Article which will be liked
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|View|\Symfony\Component\HttpFoundation\Response
     */
    public function like($code, Request $request)
    {
        $article = Articles::where('code', $code)->first();
        $article->likes += 1;
        $article->save();
        if ($request->ajax()) {
            $view = View::make('blog.article.show', compact(['article', 'code']));
            $sections = $view->renderSections();
            return response(array("content" => $sections['content']));
        } else {
            flash()->info('Úspešne ste likli článok.');
            return view('blog.article.show', compact(['article', 'code']));
        }
    }

    /**
     * Method handle POST request to comment Article
     *
     * @param string $code code of Article which will be commented
     * @param Request $request
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\Routing\ResponseFactory|View|\Symfony\Component\HttpFoundation\Response
     */
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
            if ($comment->user->notification) {
                Mail::send('blog.emails.answer_comment', ['comment' => $comment,'commented_comment' => $comm], function ($m) use ($comment) {
                    $m->from('blogin@weebto.me', 'Blogin Administrátor');
                    $m->to($comment->user->email, $comment->user->name . ' ' . $comment->user->surname)->subject('Reakcia na Váš komentár.');
                });
            }
        }
        if ($comment->articles->user->notification) {
            Mail::send('blog.emails.answer_article', ['comment' => $comment], function ($m) use ($comment) {
                $m->from('blogin@weebto.me', 'Blogin Administrátor');
                $m->to($comment->articles->user->email, $comment->articles->user->name . ' ' . $comment->articles->user->surname)->subject('Reakcia na Váš článok.');
            });
        }
        if ($request->ajax()) {
            $view = View::make('blog.article.show', compact(['article', 'code']));
            $sections = $view->renderSections();
            return response(array("content" => $sections['content']));
        } else {
            $this->validate($request, [
                'cont' => 'required'
            ], [
                'cont.required' => 'Obsah komentáru nemôže byť prázdny!'
            ]);
            flash()->info('Úspešne ste komentovali článok.');
            return view('blog.article.show', compact(['article', 'code']));
        }
    }

    /**
     * Method return image of Article
     *
     * @param string $code code of Article which image will be returned
     * @author Lukas Figura <figurluk@gmail.com>
     * @return mixed
     */
    public function getImage($code)
    {
        $disk = Storage::disk('local');
        if ($code == "default")
            return $disk->get('/articles_img/default.png');
        else
            return $disk->get('/articles_img/' . Articles::where('code', $code)->first()->image);
    }

}
