<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTagRequest;
use App\Tags;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tags::paginate(10);
        return view('admin.tags.index', compact(['tags']));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

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

    public function edit($id)
    {
        $tag = Tags::find($id);
        return view('admin.tags.edit', compact(['tag']));
    }

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

    public function remove($id)
    {
        $tag = Tags::find($id);
        flash()->info('Úspešne ste zmazali tag: ' . $tag->name);
        $tag->delete();
        return redirect()->action('Admin\TagsController@index');
    }
}
