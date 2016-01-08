<?php

namespace App\Http\Controllers\Admin;

use App\Settings;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index()
    {
        $settings = Settings::first();
        return view('admin.settings.index', compact(['settings']));
    }

    public function update(Request $request)
    {
        $settings = Settings::first();
        $settings->design = $request->design;
        $settings->save();
        flash()->info('Úspešne ste upravili nastavenia blogu.');
        return redirect()->action('Admin\SettingsController@index');
    }
}
