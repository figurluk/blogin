<?php

namespace App\Http\Controllers\Blog;

use App\Articles;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * Class HomeController
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Http\Controllers\Blog
 */
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periods = $this->getPeriods('');
        $articles = Articles::orderBy('updated_at', 'desc')->take(10)->get();
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

        return view('blog.home.index', compact(['periods', 'articles', 'mainArt', 'firstSub', 'secondSub', 'firstSubSub', 'secondSubSub', 'thirdSubSub']));
    }

    public function filterIndex($month,$year)
    {
        $periods = $this->getPeriods('');
        $articles = Articles::select(DB::raw('*, month(updated_at) as month, year(updated_at) as year'))
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

        return view('blog.home.index', compact(['month','year','periods', 'articles', 'mainArt', 'firstSub', 'secondSub', 'firstSubSub', 'secondSubSub', 'thirdSubSub']));
    }

    public function more($count)
    {
        $periods = $this->getPeriods('');
        $articles = Articles::orderBy('updated_at', 'desc')->take($count)->get();
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

        return view('blog.home.index', compact(['periods', 'articles', 'mainArt', 'firstSub', 'secondSub', 'firstSubSub', 'secondSubSub', 'thirdSubSub']));
    }

    public function filterMore($month,$year,$count)
    {
        $periods = $this->getPeriods('');
        $articles = Articles::select(DB::raw('*, month(updated_at) as month, year(updated_at) as year'))
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

        return view('blog.home.index', compact(['month','year','periods', 'articles', 'mainArt', 'firstSub', 'secondSub', 'firstSubSub', 'secondSubSub', 'thirdSubSub']));
    }

    public function next($start)
    {
        $articles = DB::table('articles')->orderBy('updated_at', 'desc')->skip($start)->take(4)->get();
        return view('blog.home.next', compact(['articles']));
    }

    public function filterNext($month,$year,$start)
    {
        $articles = Articles::select(DB::raw('*, month(updated_at) as month, year(updated_at) as year'))
            ->where(DB::raw('month(updated_at)'),$month)->where(DB::raw('year(updated_at)'),$year)->orderBy('updated_at', 'desc')->skip($start)->take(4)->get();
        return view('blog.home.next', compact(['articles']));
    }

    private function getPeriods()
    {
        $periods = Articles::select(DB::raw('month(updated_at) as month, year(updated_at) as year'))->groupBy('month', 'year')
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
