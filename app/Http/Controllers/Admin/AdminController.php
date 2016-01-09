<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class AdminController
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{
    /**
     * AdminController constructor.
     * @author Lukas Figura <figurluk@gmail.com>
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }


    /**
     * Method display a home page of Admin.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home.index');
    }

}
