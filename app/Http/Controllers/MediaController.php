<?php

namespace App\Http\Controllers;

use App\Media;
use App\Category;
use App\CategoryMediaController;
use Illuminate\Http\Request;
use App\Http\Requests\MediaRequest;
use Illuminate\Support\Facades\Gate;

class MediaController extends Controller
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
        if (Gate::check('isAdmin') || Gate::check('isSuperAdmin')) {
            $medias = Media::get();
            $categories = Category::orderBy('cat_slug', 'asc')->get();
            return view('media.index', compact('medias', 'categories'));
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
            $categories = Category::orderBy('created_at', 'desc')->get();
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
                $arr[] = Category::where('id', $cats)->whereDoesntHave('medias', function ($query) use ($request){
                    $search = array(" ", "(", ")", "_", "-", "/", "\\", "\'", "*", "=", "+", "@", "%", "^");
                    $stipedName = str_replace($search, "", $request->file_name->getClientOriginalName());
                    $fileName = $stipedName;
                    $query->where('file_name', $fileName);
                })->get();
            }
            if ($request->has('file_name')) {
                $search = array(" ", "(", ")", "_", "-", "/", "\\", "\'", "*", "=", "+", "@", "%", "^");
                $stipedName = str_replace($search, "", $request->file_name->getClientOriginalName());
                $fileName = $stipedName;
                foreach ($arr as $cate) {
                    if (count($cate) != 0) {
                        $filepath = 'public/uploaded/media/'.$cate[0]->cat_slug;
                        $request->file('file_name')->storeAs($filepath, $fileName);
                    }
                }
                $atts['file_name'] = $fileName;
                $mediaSearch = Media::where('file_name', $fileName)->first();
                if ($mediaSearch === NULL) {
                    $lastInserted = Media::create($atts);
                }else{
                    $lastInserted = $mediaSearch;
                }
                $cat_ids = $request->input('category_id');
                foreach ($cat_ids as $cat_id) {
                    if ($lastInserted->categories()->where('id', $cat_id)->doesntExist() == true) {
                        $cat = Category::find($cat_id);
                        $cat->medias()->attach($lastInserted->id);
                    }
                }
                return back();
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
        // dd($media);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show_cat(Category $category)
    {
        return view('media.media_show', compact('category'));
    }
}
