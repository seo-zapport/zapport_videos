<?php

namespace App\Http\Controllers;

use App\Media;
use App\Category;
use App\Category_media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CategoryMediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category_media  $category_media
     * @return \Illuminate\Http\Response
     */
    public function show(Category_media $category_media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category_media  $category_media
     * @return \Illuminate\Http\Response
     */
    public function edit(Category_media $category_media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category_media  $category_media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category_media $category_media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category_media  $category_media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category_media $category_media, $category_id, $media_id)
    {
        if (Gate::check('isAdmin') || Gate::check('isSuperAdmin')) {
            $cat = Category::find($category_id);
            $med = Media::find($media_id);
            if (count($med->categories) <= 1) {
                $med->delete();
            }
            $med->categories()->detach($category_id);
            Storage::delete('public/uploaded/media/'.$cat->cat_slug.'/'.$med->file_name);
            return back();
        }else{
            return back();
        }
    }
}
