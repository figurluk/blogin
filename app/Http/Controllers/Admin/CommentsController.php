<?php

namespace App\Http\Controllers\Admin;

use App\Articles;
use App\Comments;
use App\Http\Requests\CreateCommentRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $comments = Comments::paginate(10);
        return view('admin.comments.index', compact(['comments']));
    }

    public function today()
    {
        return view('admin.comments.today');
    }

    public function create()
    {
        $articles = Articles::pluck('title', 'id')->all();
        $articles = [0 => 'Vyberte clanok'] + $articles;
        return view('admin.comments.create', compact(['articles']));
    }

    public function store(CreateCommentRequest $request)
    {
        if ($request->article == 0) {
            $request->flash();
            return redirect()->back()->withInput()->withErrors(['article' => 'Musite mat vybrany clanok, ktoremu chcete pridat komentar']);
        }
        $comment = new Comments();
        $comment->content = trim($request->cont, " \t");
        $comment->user()->associate(Auth::user());
        $comment->articles()->associate(Articles::find($request->article));
        $comment->save();

        flash()->info('Uspesne ste vytvorili komentar k clanku: ' . $comment->articles->title);
        if (isset($request->save))
            return redirect()->action('Admin\CommentsController@edit', $comment->id);
        else {
            return redirect()->action('Admin\CommentsController@index');
        }

    }

    public function edit($id)
    {
        $articles = Articles::pluck('title', 'id')->all();
        $articles = [0 => 'Vyberte clanok'] + $articles;
        $comment = Comments::find($id);
        return view('admin.comments.edit', compact(['comment','articles']));
    }

    public function update($id, Request $request)
    {
        if ($request->article == 0) {
            $request->flash();
            return redirect()->back()->withInput()->withErrors(['article' => 'Musite mat vybrany clanok, ktoremu chcete pridat komentar']);
        }

        $comment = Comments::find($id);
        $comment->content = trim($request->cont, " \t");
        $comment->user()->associate(Auth::user());
        $comment->articles()->associate(Articles::find($request->article));
        $comment->save();


        flash()->info('Uspesne ste upravili komentar k clanku: ' . $comment->articles->title);
        if (isset($request->update))
            return redirect()->action('Admin\CommentsController@edit', $comment->id);
        else {
            return redirect()->action('Admin\CommentsController@index');
        }
    }

    public function remove($id)
    {
        $comment = Comments::find($id);
        flash()->info('Uspesne ste zmazali komentar k clanku: ' . $comment->articles->title);
        $comment->delete();
        return redirect()->action('Admin\CommentsController@index');
    }
}
