<?php

namespace App\Providers;

use App\Articles;
use App\Comments;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $periods = DB::table('articles')->select(DB::raw('month(updated_at) as month, year(updated_at) as year'))->groupBy('month', 'year')
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

        $newArticles = Articles::where(DB::raw('DATE(created_at)'), '=', Carbon::today())->get();
        $newUsers = User::where(DB::raw('DATE(created_at)'), '=', Carbon::today())->get();
        $newComments = Comments::where(DB::raw('DATE(created_at)'), '=', Carbon::today())->get();

        view()->share('periods', $periods);
        view()->share('newArticles', $newArticles);
        view()->share('newUsers', $newUsers);
        view()->share('newComments', $newComments);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
