<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTagRequest;
use App\Tags;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class TagsController
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Http\Controllers\Admin
 */
class TagsController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }


    /**
     * Display a list of Tags.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tags::paginate(10);
        return view('admin.tags.index', compact(['tags']));
    }

    /**
     * Display view for create Tag
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Method handle POST request to create Tag
     *
     * @param CreateTagRequest $request
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTagRequest $request)
    {
        $tag = new Tags();
        $tag->name = $request->name;
        $tag->save();

        flash()->info('Úspešne ste vytvorili tag: ' . $tag->name);
        if (isset($request->save))
            return redirect()->action('Admin\TagsController@edit', $tag->id);
        else {
            return redirect()->action('Admin\TagsController@index');
        }

    }

    /**
     * Display details of Tag
     *
     * @param int $id id of displayed Tag
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $tag = Tags::find($id);
        return view('admin.tags.edit', compact(['tag']));
    }

    /**
     * Method handle POST request to update Tag
     *
     * @param int $id id of Tag which will be updated
     * @param Request $request
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $tag = Tags::find($id);
        if ($tag->name != $request->name) {
            $this->validate($request, [
                'name' => 'required|string|unique:tags,deleted_at,NULL',
            ], [
                'name.required' => 'Názov tagu je povinný.',
                'name.string' => 'Názov tagu musí byť postupnosť znakov.',
                'name.unique' => 'Názov tagu musí byť unikátne.',
            ]);
        }
        $tag->name = $request->name;
        $tag->save();

        flash()->info('Úspešne ste upravili tag: ' . $tag->name);
        if (isset($request->update))
            return redirect()->action('Admin\TagsController@edit', $tag->id);
        else {
            return redirect()->action('Admin\TagsController@index');
        }
    }

    /**
     * Method removes Tag
     *
     * @param int $id id of Tag which will be removed
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        $tag = Tags::find($id);
        flash()->info('Úspešne ste zmazali tag: ' . $tag->name);
        $tag->delete();
        return redirect()->action('Admin\TagsController@index');
    }
}
