<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App\Http\Controllers\Blog;

use App\Tags;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * Class TagsController
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Http\Controllers\Blog
 */
class TagsController extends Controller
{

    /**
     * Display Articles filtred by Tag which is attached to them
     *
     * @param string $code code of Tag
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($code)
    {
        $periods = $this->getPeriods($code);
        $tag = Tags::where('code', $code)->first();
        $articles = $tag->articles()->orderBy('created_at', 'desc')->take(10)->get();

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

    /**
     * Method display Articles, filtred by month and year when was updated and Tag which is attached to them.
     *
     * @param string $code code of Tag
     * @param int $month month of getted Articles
     * @param int $year year of getted Articles
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filterShow($code, $month, $year)
    {
        $periods = $this->getPeriods($code);
        $tag = Tags::where('code', $code)->first();
        $articles = $tag->articles()->select(DB::raw('*, month(created_at) as month, year(created_at) as year'))
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

        return view('blog.tag.filter', compact(['month', 'year', 'periods', 'tag', 'articles', 'mainArt', 'firstSub', 'secondSub', 'firstSubSub', 'secondSubSub', 'thirdSubSub']));
    }


    /**
     * Display specific count of Articles filtred by Tag which is attached to them.
     *
     * @param string $code code of Tag
     * @param int $count count of Articles
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function more($code, $count)
    {
        $periods = $this->getPeriods($code);
        $tag = Tags::where('code', $code)->first();
        $articles = $tag->articles()->orderBy('created_at', 'desc')->take($count)->get();
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

    /**
     * Display specific count of Articles filtred by month and year when was updated and Tag which is attached to them.
     *
     * @param string $code code of Tag
     * @param int $month month of getted Articles
     * @param int $year year of getted Articles
     * @param int $count count of Articles
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filterMore($code, $month, $year, $count)
    {
        $periods = $this->getPeriods($code);
        $tag = Tags::where('code', $code)->first();
        $articles = $tag->articles()->select(DB::raw('*, month(created_at) as month, year(created_at) as year'))
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

        return view('blog.tag.filter', compact(['month', 'year', 'periods', 'tag', 'articles', 'mainArt', 'firstSub', 'secondSub', 'firstSubSub', 'secondSubSub', 'thirdSubSub']));
    }

    /**
     * Display specific 4 Articles filtred by Tag which is attached to them
     *
     * @param string $code code of Tag
     * @param int $start count of Articles which are skipped from result of getting Articles from database
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function next($code, $start)
    {
        $tag = Tags::where('code', $code)->first();
        $articles = $tag->articles()->orderBy('created_at', 'desc')->skip($start)->take(4)->get();
        return view('blog.tag.next', compact(['articles']));
    }

    /**
     * Display specific 4 Articles filtred by month and year when was update and Tag which is attached to them
     *
     * @param string $code code of Tag
     * @param int $month month of getted Articles
     * @param int $year year of getted Articles
     * @param int $start count of Articles which are skipped from result of getting Articles from database
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filterNext($code, $month, $year, $start)
    {
        $tag = Tags::where('code', $code)->first();
        $articles = $tag->articles()->select(DB::raw('*, month(created_at) as month, year(created_at) as year'))
            ->where(DB::raw('month(created_at)'), $month)->where(DB::raw('year(created_at)'), $year)->orderBy('created_at', 'desc')->skip($start)->take(4)->get();
        return view('blog.tag.next', compact(['articles']));
    }

    /**
     * Method create array for calendar filter, filtred by code of Tag which is attach to Articles
     * @param string $tagCode code of Tag
     * @author Lukas Figura <figurluk@gmail.com>
     * @return array item contains number of month, number of year, month name
     */
    private function getPeriods($tagCode)
    {
        $tag = Tags::where('code', $tagCode)->first();
        $periods = $tag->articles()->select(DB::raw('month(created_at) as month, year(created_at) as year'))->groupBy('month', 'year')
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
