<?php

namespace App\Http\Controllers\Blog;

use App\Articles;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Articles::orderBy('updated_at','desc')->take(10)->get();
        $mainArt = null;
        $firstSub = null;
        $secondSub = null;
        $firstSubSub = null;
        $secondSubSub = null;
        $thirdSubSub = null;
        foreach ($articles as $key => $article) {
            if ($article->topped && $mainArt == null) {
                $mainArt = $article;
                $articles->forget($key);
            } elseif ($article->topped && $firstSub == null) {
                $firstSub = $article;
                $articles->forget($key);
            } elseif ($article->topped && $secondSub == null) {
                $secondSub = $article;
                $articles->forget($key);
            } elseif ($article->topped && $firstSubSub == null) {
                $firstSubSub = $article;
                $articles->forget($key);
            } elseif ($article->topped && $secondSubSub == null) {
                $secondSubSub = $article;
                $articles->forget($key);
            } elseif ($article->topped && $thirdSubSub == null) {
                $thirdSubSub = $article;
                $articles->forget($key);
            }
        }
        foreach ($articles as $key => $article) {
            if ($mainArt == null) {
                $mainArt = $article;
                $articles->forget($key);
            } elseif ($firstSub == null) {
                $firstSub = $article;
                $articles->forget($key);
            } elseif ($secondSub == null) {
                $secondSub = $article;
                $articles->forget($key);
            } elseif ($firstSubSub == null) {
                $firstSubSub = $article;
                $articles->forget($key);
            } elseif ($secondSubSub == null) {
                $secondSubSub = $article;
                $articles->forget($key);
            } elseif ($thirdSubSub == null) {
                $thirdSubSub = $article;
                $articles->forget($key);
            }
        }

        return view('blog.home.index', compact(['articles', 'mainArt', 'firstSub', 'secondSub', 'firstSubSub', 'secondSubSub', 'thirdSubSub']));
    }

    public function more($count){
        $articles = Articles::orderBy('updated_at','desc')->take($count)->get();
        $mainArt = null;
        $firstSub = null;
        $secondSub = null;
        $firstSubSub = null;
        $secondSubSub = null;
        $thirdSubSub = null;
        foreach ($articles as $key => $article) {
            if ($article->topped && $mainArt == null) {
                $mainArt = $article;
                $articles->forget($key);
            } elseif ($article->topped && $firstSub == null) {
                $firstSub = $article;
                $articles->forget($key);
            } elseif ($article->topped && $secondSub == null) {
                $secondSub = $article;
                $articles->forget($key);
            } elseif ($article->topped && $firstSubSub == null) {
                $firstSubSub = $article;
                $articles->forget($key);
            } elseif ($article->topped && $secondSubSub == null) {
                $secondSubSub = $article;
                $articles->forget($key);
            } elseif ($article->topped && $thirdSubSub == null) {
                $thirdSubSub = $article;
                $articles->forget($key);
            }
        }
        foreach ($articles as $key => $article) {
            if ($mainArt == null) {
                $mainArt = $article;
                $articles->forget($key);
            } elseif ($firstSub == null) {
                $firstSub = $article;
                $articles->forget($key);
            } elseif ($secondSub == null) {
                $secondSub = $article;
                $articles->forget($key);
            } elseif ($firstSubSub == null) {
                $firstSubSub = $article;
                $articles->forget($key);
            } elseif ($secondSubSub == null) {
                $secondSubSub = $article;
                $articles->forget($key);
            } elseif ($thirdSubSub == null) {
                $thirdSubSub = $article;
                $articles->forget($key);
            }
        }

        return view('blog.home.index', compact(['articles', 'mainArt', 'firstSub', 'secondSub', 'firstSubSub', 'secondSubSub', 'thirdSubSub']));
    }

    public function next($start){
        $limit = $start+4;
        $articles = DB::table('articles')->orderBy('updated_at','desc')->skip(intval($start))->take($limit)->get();
        dd($articles,intval($start),$limit);
        return view('blog.home.next', compact(['articles']));
    }
}
