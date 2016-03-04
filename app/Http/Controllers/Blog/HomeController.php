<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

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
     * Display home page of Blogin with Articles ordered by date of updating.
     * Topped articles are in top of page.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periods = $this->getPeriods('');
        $articles = Articles::orderBy('created_at', 'desc')->take(10)->get();
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

    /**
     * Display Articles updated in specific month and year.
     * Topped articles are in top of page.
     *
     * @param int $month month of updated Articles
     * @param int $year year of updated Articles
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filterIndex($month, $year)
    {
        $periods = $this->getPeriods('');
        $articles = Articles::select(DB::raw('*, month(created_at) as month, year(created_at) as year'))
            ->where(DB::raw('month(created_at)'), $month)->where(DB::raw('year(created_at)'), $year)->orderBy('created_at', 'desc')->take(10)->get();

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

        return view('blog.home.filter', compact(['month', 'year', 'periods', 'articles', 'mainArt', 'firstSub', 'secondSub', 'firstSubSub', 'secondSubSub', 'thirdSubSub']));
    }

    /**
     * Method display specific count of Articles
     *
     * @param int $count count of Articles which will be getted from database
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function more($count)
    {
        $periods = $this->getPeriods('');
        $articles = Articles::orderBy('created_at', 'desc')->take($count)->get();
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

    /**
     * Display specific count of Articles filtred by month and year when was updated
     *
     * @param int $month month of getted Articles
     * @param int $year year of getted Artices
     * @param int $count count of Articles which will be getted from database
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filterMore($month, $year, $count)
    {
        $periods = $this->getPeriods('');
        $articles = Articles::select(DB::raw('*, month(created_at) as month, year(created_at) as year'))
            ->where(DB::raw('month(created_at)'), $month)->where(DB::raw('year(created_at)'), $year)->orderBy('created_at', 'desc')->take($count)->get();
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

        return view('blog.home.filter', compact(['month', 'year', 'periods', 'articles', 'mainArt', 'firstSub', 'secondSub', 'firstSubSub', 'secondSubSub', 'thirdSubSub']));
    }

    /**
     * Display specific 4 Articles from database
     *
     * @param int $start count of Articles which are skipped from result of getting Articles from database
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function next($start)
    {
        $articles = DB::table('articles')->orderBy('created_at', 'desc')->skip($start)->take(4)->get();
        return view('blog.home.next', compact(['articles']));
    }

    /**
     * Display specific 4 Articles from database filtred by month and year when was updated
     *
     * @param int $month month of getted Articles
     * @param int $year year of getted Articles
     * @param int $start count of Articles which are skipped from result of getting Articles from database
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filterNext($month, $year, $start)
    {
        $articles = Articles::select(DB::raw('*, month(created_at) as month, year(created_at) as year'))
            ->where(DB::raw('month(created_at)'), $month)->where(DB::raw('year(created_at)'), $year)->orderBy('created_at', 'desc')->skip($start)->take(4)->get();
        return view('blog.home.next', compact(['articles']));
    }

    /**
     * Method create array for calendar filter
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return array item contains number of month, number of year, month name
     */
    private function getPeriods()
    {
        $periods = Articles::select(DB::raw('month(created_at) as month, year(created_at) as year'))->groupBy('month', 'year')
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
