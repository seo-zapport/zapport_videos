<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
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
            $categories = Category::orderBy('categories', 'asc')->get();
            return view('category.index', compact('categories'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if (Gate::check('isAdmin') || Gate::check('isSuperAdmin')) {
            if ($request->ajax()) {
                $atts = $this->validate($request, $request->rules(), $request->messages());
                $slug = str_replace(' ', '-', $request->categories);
                $atts['cat_slug'] = $slug;
                $lastID = Category::create($atts);
                $atts['id'] = $lastID->id;

                $mediaFold = 'storage/uploaded/media/'.strtolower($lastID->cat_slug);
                if (!file_exists($mediaFold)) {
                    mkdir($mediaFold, 777, true);
                }

                return response()->json($atts);
            }else{
                return back();
            }
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if (Gate::check('isAdmin') || Gate::check('isSuperAdmin')) {
            $atts = $request->validate([
                'categories'    =>  ['required','unique:categories,categories,'.$category->id],
            ]);
            $atts['categories'] = strtolower($request->categories);
            $atts['cat_slug'] = str_replace(' ', '-', strtolower($request->categories));
            $loc = 'storage/uploaded/media/';
            rename($loc.'/'.$category->cat_slug, $loc.'/'.$atts['cat_slug']);
            $category->update($atts);
            return back();
        }else{
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (Gate::check('isAdmin') || Gate::check('isSuperAdmin')) {
            if (count($category->medias) > 0) {
                return back()->with('delete_error', 'You cannot delete a category with post');
            }else{
                $loc = 'storage/uploaded/media/';
                rmdir($loc.'/'.$category->cat_slug);
                $category->delete();
                return back();
            }
        }else{
            return back();
        }
    }
}
