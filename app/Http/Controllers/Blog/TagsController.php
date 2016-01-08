<?php

namespace App\Http\Controllers\Blog;

use App\Tags;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{

    public function show($code)
    {
        $periods = $this->getPeriods($code);
        $tag = Tags::where('code', $code)->first();
        $articles = $tag->articles()->orderBy('updated_at', 'desc')->take(10)->get();

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

        return view('blog.tag.index', compact(['periods', 'tag', 'articles', 'mainArt', 'firstSub', 'secondSub', 'firstSubSub', 'secondSubSub', 'thirdSubSub']));
    }

    public function filterShow($month,$year,$code)
    {
        $periods = $this->getPeriods($code);
        $tag = Tags::where('code', $code)->first();
        $articles = $tag->articles()->select(DB::raw('*, month(updated_at) as month, year(updated_at) as year'))
            ->where(DB::raw('month(updated_at)'),$month)->where(DB::raw('year(updated_at)'),$year)->orderBy('updated_at', 'desc')->get();

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

        return view('blog.tag.index', compact(['month','year','periods', 'tag', 'articles', 'mainArt', 'firstSub', 'secondSub', 'firstSubSub', 'secondSubSub', 'thirdSubSub']));
    }


    public function more($code, $count)
    {
        $periods = $this->getPeriods($code);
        $tag = Tags::where('code', $code)->first();
        $articles = $tag->articles()->orderBy('updated_at', 'desc')->take($count)->get();
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

        return view('blog.home.index', compact(['periods', 'tag', 'articles', 'mainArt', 'firstSub', 'secondSub', 'firstSubSub', 'secondSubSub', 'thirdSubSub']));
    }

    public function filterMore($month,$year,$code,$count)
    {
        $periods = $this->getPeriods($code);
        $tag = Tags::where('code', $code)->first();
        $articles = $tag->articles()->select(DB::raw('*, month(updated_at) as month, year(updated_at) as year'))
            ->where(DB::raw('month(updated_at)'),$month)->where(DB::raw('year(updated_at)'),$year)->orderBy('updated_at', 'desc')->take($count)->get();
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

        return view('blog.home.index', compact(['month','year','periods', 'tag', 'articles', 'mainArt', 'firstSub', 'secondSub', 'firstSubSub', 'secondSubSub', 'thirdSubSub']));
    }

    public function next($code, $start)
    {
        $tag = Tags::where('code', $code)->first();
        $articles = $tag->articles()->orderBy('updated_at', 'desc')->skip($start)->take(4)->get();
        return view('blog.home.next', compact(['articles']));
    }


    public function filterNext($month,$year,$code,$start)
    {
        $tag = Tags::where('code', $code)->first();
        $articles = $tag->articles()->select(DB::raw('*, month(updated_at) as month, year(updated_at) as year'))
            ->where(DB::raw('month(updated_at)'),$month)->where(DB::raw('year(updated_at)'),$year)->orderBy('updated_at', 'desc')->skip($start)->take(4)->get();
        return view('blog.home.next', compact(['articles']));
    }

    private function getPeriods($tagCode)
    {
        $tag = Tags::where('code', $tagCode)->first();
        $periods = $tag->articles()->select(DB::raw('month(updated_at) as month, year(updated_at) as year'))->groupBy('month', 'year')
            ->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        $months = array(
            1 => 'Január',
            2 => 'Február',
            3 => 'Marec',
            4 => 'Apríl',
            5 => 'Máj',
            6 => 'Jún',
            7 => 'Júl',
            8 => 'August',
            9 => 'Septemer',
            10 => 'Október',
            11 => 'November',
            12 => 'December',
        );

        foreach ($periods as $period) {
            $period->monthName = $months[$period->month];
        }

        return $periods->toArray();
    }
}
