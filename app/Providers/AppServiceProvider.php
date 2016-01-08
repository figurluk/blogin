<?php

namespace App\Providers;

use App\Articles;
use App\Comments;
use App\Tags;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $newArticles = Articles::where(DB::raw('DATE(created_at)'), '=', Carbon::today())->paginate(10);
        $newUsers = User::where(DB::raw('DATE(created_at)'), '=', Carbon::today())->paginate(10);
        $newComments = Comments::where(DB::raw('DATE(created_at)'), '=', Carbon::today())->paginate(10);
        $menuTags = DB::table('articles_tags')->select(DB::raw('tags_id as id'),DB::raw('count(*) as count'))->groupBy('tags_id')->orderBy('count','desc')->get();

        view()->share('newArticles', $newArticles);
        view()->share('newUsers', $newUsers);
        view()->share('newComments', $newComments);
        view()->share('menuTags', $menuTags);
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
