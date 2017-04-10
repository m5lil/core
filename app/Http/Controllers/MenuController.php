<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Menu;
use Session;
use App\Page;
use Validator;


class MenuController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderBy('parent_id', 'asc')->orderBy('order', 'asc')->get();
        $title = Menu::translated()->get()->pluck('title', 'id');
        $title = array_add($title, '0', 'بدون');
        $parents_menu = array_add(Menu::translated()->get()->pluck('title', 'slug'), '0', 'بدون');
        $pages1 = Page::translated()->get()->pluck('title', 'slug')->toArray();
        $categories = Category::translated()->get()->pluck('title', 'slug')->toArray();
        $pages = array_merge($categories, $pages1);
        return view('backend.menu.index', compact('menus', 'title', 'parents_menu', 'pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title.*' => 'required',
            'order'   => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::to('dashboard/menu')
                ->withErrors($validator);
        } else {
            $menu = new Menu();
            $menu->parent_id = $request->parent_id ? $request->parent_id : 0;
            if (in_array($request->url, Category::pluck('slug')->toArray())) {
                $menu->url = '/section/' . $request->url;
            } else {
                $menu->url = $request->url;
            }
            // $menu->url = in_array( $request->url , Page::pluck('title','slug')->toArray()) ?  'page/'.$request->url : $request->url ;
            $menu->order = $request->order;
            $menu->save();
            foreach (config('app.locals') as $locale) {
                $menu->translateOrNew($locale)->title = $request->title[ $locale ];
            }
            $menu->save();
            // redirect
            Session::flash('message', 'تم بنجاح!');
            return Redirect::to('dashboard/menu');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::findOrfail($id);
        $menus = Menu::translated()->get()->where('id', '!=', $menu->id)->pluck('title', 'id');
        $menus = array_add($menus, '0', 'بدون');
        $pages1 = Page::translated()->get()->pluck('title', 'slug')->toArray();
        $categories = Category::translated()->get()->pluck('title', 'slug')->toArray();
        $pages = array_merge($categories, $pages1);

        return view('backend.menu.edit', compact('menu', 'menus','pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title.*' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::to('dashboard/menu')
                ->withErrors($validator);
        } else {
            $menu = Menu::findOrFail($id);
            $menu->parent_id = $request->parent_id ? $request->parent_id : 0;
            // $menu->url = in_array( $request->url , Page::pluck('title','slug')->toArray()) ?  'page/'.$request->url : $request->url ;
            if (in_array($request->url, Category::pluck('slug')->toArray())) {
                $menu->url = '/section/' . $request->url;
            } else {
                $menu->url = $request->url;
            }

            $menu->order = $request->order;
            $menu->save();
            foreach (config('app.locals') as $locale) {
                $menu->translateOrNew($locale)->title = $request->title[ $locale ];
            }
            $menu->save();
            // redirect
            Session::flash('message', 'تم بنجاح!');
            return Redirect::to('dashboard/menu');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrfail($id);
        $menu->delete();
        $menu->children()->delete();
        Session::flash('message', 'تم بنجاح!');
        return redirect('dashboard/menu');
    }
}
