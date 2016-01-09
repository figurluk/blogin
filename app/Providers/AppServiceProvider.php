<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App\Providers;

use App\Articles;
use App\Comments;
use App\Tags;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return void
     */
    public function boot()
    {
        $newArticles = Articles::where(DB::raw('DATE(created_at)'), '=', DB::raw('CURDATE()'))->paginate(10);
        $countNewArticles = count(Articles::where(DB::raw('DATE(created_at)'), '=', DB::raw('CURDATE()'))->get());
        $newUsers = User::where(DB::raw('DATE(created_at)'), '=', DB::raw('CURDATE()'))->paginate(10);
        $countNewUsers = count(User::where(DB::raw('DATE(created_at)'), '=', DB::raw('CURDATE()'))->get());
        $newComments = Comments::where(DB::raw('DATE(created_at)'), '=', DB::raw('CURDATE()'))->paginate(10);
        $countNewComments = count(Comments::where(DB::raw('DATE(created_at)'), '=', DB::raw('CURDATE()'))->get());
        $menuTags = DB::table('articles_tags')->select(DB::raw('tags_id as id'), DB::raw('count(*) as count'))->groupBy('tags_id')->orderBy('count', 'desc')->get();

        view()->share('newArticles', $newArticles);
        view()->share('newUsers', $newUsers);
        view()->share('newComments', $newComments);
        view()->share('countNewArticles', $countNewArticles);
        view()->share('countNewUsers', $countNewUsers);
        view()->share('countNewComments', $countNewComments);
        view()->share('menuTags', $menuTags);
    }

    /**
     * Register any application services.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return void
     */
    public function register()
    {
        //
    }
}
