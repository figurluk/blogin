<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App\Http\Controllers\Admin;

use App\Settings;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class SettingsController
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Http\Controllers\Admin
 */
class SettingsController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * Display view with settings.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $settings = Settings::first();
        return view('admin.settings.index', compact(['settings']));
    }

    /**
     * Method handle POST request to update Settings
     *
     * @param Request $request
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $settings = Settings::first();
        $settings->design = $request->design;
        $settings->save();
        flash()->info('Úspešne ste upravili nastavenia blogu.');
        return redirect()->action('Admin\SettingsController@index');
    }
}
