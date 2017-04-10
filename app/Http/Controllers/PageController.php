<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Session;
use App\Page;
use Jenssegers\Date\Date;
use Validator;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pages = Page::all();
        return view('backend.pages.index', compact('pages'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'body.*' => 'required',
            'slug' => 'required'
        ]);
        if ($validator->fails()) {
            return Redirect::to('dashboard/pages')
                ->withErrors($validator);
        } else {
            $request = $this->saveFiles($request);
            $page = New Page();
            $request->has('statue') ? $page->statue = 1 : $page->statue = 0;
            $page->photo = $request->photo;
            $page->slug = $request->slug;

            $page->save();
            foreach (config('app.locals') as $locale) {
                $page->translateOrNew($locale)->title = $request->title[$locale];
                $page->translateOrNew($locale)->body = $request->body[$locale];
                $page->translateOrNew($locale)->seo_title = $request->seo_title[$locale];
                $page->translateOrNew($locale)->seo_keywords = $request->seo_keywords[$locale];
                $page->translateOrNew($locale)->seo_description = $request->seo_description[$locale];
            }
            $page->save();
            // redirect
            Session::flash('message', 'تم بنجاح!');
            return Redirect::to('dashboard/pages');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->first();
//        dd($page);
        return view('frontend.page', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        return view('backend.pages.edit', compact('page'));
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
            'body.*' => 'required',
            'slug' => 'required'
        ]);
        if ($validator->fails()) {
            return Redirect::to('dashboard/pages')
                ->withErrors($validator);
        } else {
            $request = $this->saveFiles($request);

            $page = Page::findOrFail($id);
//            dd($request);
            $page->statue = $request->has('statue') ? 1 : 0;
            !$request->has('photo') ?: $page->photo = $request->photo;
            !$request->has('slug') ?: $page->slug = $request->slug;
            $page->save();
            foreach (config('app.locals') as $locale) {
                $page->translateOrNew($locale)->title = $request->title[$locale];
                $page->translateOrNew($locale)->body = $request->body[$locale];
                $page->translateOrNew($locale)->seo_title = $request->seo_title[$locale];
                $page->translateOrNew($locale)->seo_keywords = $request->seo_keywords[$locale];
                $page->translateOrNew($locale)->seo_description = $request->seo_description[$locale];
            }
            $page->save();
            // redirect
            Session::flash('message', 'تم بنجاح!');
            return Redirect::to('dashboard/pages');
        }

    }

    public function ajax(Request $request)
    {
        // ($request);
        $page = Page::findOrFail($request->id);
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->body = $request->body;
        $page->statue = $request->statue;
        $page->seo_title = $request->seo_title;
        $page->seo_keywords = $request->seo_keywords;
        $page->seo_description = $request->seo_description;

        $page->save();
        $msg = 'message';
        return response()->json($msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::destroy($id);
        Session::flash('message', 'تم الحذف !');
        return Redirect::to('dashboard/pages');

    }

    public function delete(Request $request)
    {
        Page::find($request->id)->delete();
        Session::flash('message', 'تم الحذف س!');
        return Redirect::to('dashboard/pages');
    }
}
