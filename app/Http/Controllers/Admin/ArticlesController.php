<?php

namespace App\Http\Controllers\Admin;

use App\Articles;
use App\Http\Requests\CreateArticleRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
        return view('admin.articles.index', compact(['articles']));
    }

    public function today()
    {
        return view('admin.articles.today');
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(CreateArticleRequest $request)
    {
        $disk = Storage::disk('local');
        $article = new Articles();
        $article->title = $request->title;
        $article->content = $request->cont;
        $article->topped = $request->topped;

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

        if (isset($request->save))
            return redirect()->action('Admin\ArticlesController@edit', $article->id);
        else
            return redirect()->action('Admin\ArticlesController@index');

    }

    public function edit($id)
    {
        $article = Articles::find($id);
        return view('admin.articles.edit', compact(['article']));
    }

    public function update($id, CreateArticleRequest $request)
    {
        $disk = Storage::disk('local');
        $article = Articles::find($id);
        $article->title = $request->title;
        $article->content = $request->cont;
        $article->topped = $request->topped;

        if (Input::file('image') != null) {
            $image = Input::file('image');
            $destinationPath = $disk->getDriver()->getAdapter()->getPathPrefix();
            $destinationPath .= "articles_img/";

            $filename = substr($image->getClientOriginalName(), strrpos($image->getClientOriginalName(), '.'));
            $filename = $article->id . $filename;

            Image::make(Input::file('image'))->save($destinationPath . $filename);
            if ($article->image != 'default.png')
                $disk->delete($destinationPath . $article->image);

            $article->image = $filename;
        }

        $article->save();

        if (isset($request->update))
            return redirect()->action('Admin\ArticlesController@edit', $article->id);
        else
            return redirect()->action('Admin\ArticlesController@index');
    }

    public function remove($id)
    {
        $article = Articles::find($id);
        flash()->info('Uspesne ste zmazali clanok: ' . $article->title);
        $article->delete();
        return redirect()->action('Admin\ArticlesController@index');
    }
}
