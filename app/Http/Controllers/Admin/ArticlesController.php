<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App\Http\Controllers\Admin;

use App\Articles;
use App\Http\Requests\CreateArticleRequest;
use App\Tags;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Class ArticlesController
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Http\Controllers\Admin
 */
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
     * Display a list of Articles.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Articles::paginate(10);
        return view('admin.articles.index', compact(['articles']));
    }

    /**
     * Display a list of Articles created today
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function today()
    {
        return view('admin.articles.today');
    }

    /**
     * Display view for creating new Article
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $tags = Tags::pluck('name', 'id');
        return view('admin.articles.create', compact(['tags']));
    }

    /**
     * Method handle POST request for create new Article
     *
     * @param CreateArticleRequest $request
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateArticleRequest $request)
    {
        $disk = Storage::disk('local');
        $article = new Articles();
        $article->title = $request->title;
        $article->content = trim($request->cont, " \t");;
        $article->topped = $request->topped;
        $article->save();
        $article->tags()->sync((array)$request->input('tags'));

        if (Input::file('image') != null) {
            $image = Input::file('image');
            $destinationPath = $disk->getDriver()->getAdapter()->getPathPrefix();
            $destinationPath .= "/articles_img/";

            $filename = substr($image->getClientOriginalName(), strrpos($image->getClientOriginalName(), '.'));
            $filename = $article->id . $filename;

            Image::make(Input::file('image'))->save($destinationPath . $filename);

            $article->image = $filename;
        }
        $article->user()->associate(Auth::user());
        $article->save();
        flash()->info('Úspešne ste vytvorili článok: ' . $article->title);
        if (isset($request->save))
            return redirect()->action('Admin\ArticlesController@edit', $article->id);
        else
            return redirect()->action('Admin\ArticlesController@index');

    }

    /**
     * Display details of Article
     *
     * @param int $id if of displayed Article
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $article = Articles::find($id);
        $tags = Tags::pluck('name', 'id');
        return view('admin.articles.edit', compact(['article', 'tags']));
    }

    /**
     * Method handle POST request to update Article
     *
     * @param int $id id of Article which will be updated
     * @param CreateArticleRequest $request
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, CreateArticleRequest $request)
    {
        $disk = Storage::disk('local');
        $article = Articles::find($id);
        $article->title = $request->title;
        $article->content = trim($request->cont, " \t");;
        $article->topped = $request->topped;
        $article->tags()->sync((array)$request->input('tags'));

        if (Input::file('image') != null) {
            $image = Input::file('image');
            $destinationPath = $disk->getDriver()->getAdapter()->getPathPrefix();
            $destinationPath .= "articles_img/";

            $filename = substr($image->getClientOriginalName(), strrpos($image->getClientOriginalName(), '.'));
            $filename = $article->id . $filename;

            if ($article->image != 'default.png') {
                $disk->delete("articles_img/" . $article->image);
            }
            Image::make(Input::file('image'))->save($destinationPath . $filename);
            $article->image = $filename;
        }

        $article->save();
        flash()->info('Úspešne ste upravili článok: ' . $article->title);
        if (isset($request->update))
            return redirect()->action('Admin\ArticlesController@edit', $article->id);
        else
            return redirect()->action('Admin\ArticlesController@index');
    }

    /**
     * Method remove Article
     *
     * @param int $id id of removed Article
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        $article = Articles::find($id);
        flash()->info('Úspešne ste zmazali článok: ' . $article->title);
        $article->delete();
        return redirect()->action('Admin\ArticlesController@index');
    }
}
