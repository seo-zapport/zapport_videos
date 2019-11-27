<?php

namespace App\Http\Controllers;

use App\Media;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\MediaRequest;
use Illuminate\Support\Facades\Gate;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::check('isAdmin') || Gate::check('isSuperAdmin')) {
            $medias = Media::get();
            return view('media.index', compact('medias'));
        }else{
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::check('isAdmin') || Gate::check('isSuperAdmin')) {
            $medias = Media::get();
            $categories = Category::get();
            return view('media.create', compact('medias', 'categories'));
        }else{
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaRequest $request)
    {
        if (Gate::check('isAdmin') || Gate::check('isSuperAdmin')) {
            $atts = $this->validate($request, $request->rules(), $request->messages());
            $atts = $request->except('category_id');
            $arr = [];
            foreach ($request->input('category_id') as $cats) {
                $arr[] = Category::find($cats);
            }
            if ($request->has('file_name')) {
                str_replace(search, replace, subject)
                $fileName = $request->file_name->getClientOriginalName();
                $mediaSearch = Media::where('file_name', $fileName)->first();
                if ($mediaSearch === NULL) {
                    foreach ($arr as $cate) {
                        $filepath = 'public/uploaded/media/'.$cate->cat_slug;
                        $request->file('file_name')->storeAs($filepath, $fileName);
                    }
                    $atts['file_name'] = $fileName;
                    $lastInserted = Media::create($atts);
                    $cat_ids = $request->input('category_id');
                    foreach ($cat_ids as $cat_id) {
                        $cat = Category::find($cat_id);
                        $cat->medias()->attach($lastInserted->id);
                    }
                    return back();
                }else{
                    return back();
                }
            }
            
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }
}
