<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['main_menu_title'] = "Products Categories";
        $data['sub_menu_title'] = "Viewing all Categories";
        $data['categories'] = Category::orderBy('name','asc')->get();
        return view('backend.categories.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('backend.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:categories|min:2|max:255',

        ];
        $this->validate($request, $rules);
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        $request->session()->flash('success', 'Category has been added successfully.');
        return response('user created !', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $data['category'] = $category;
        return view('backend.categories.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {
        $rules = [
            'name' => 'required|max:255',
        ];
        $this->validate($request, $rules);
        $category->name = $request->name;
        $category->save();

        $request->session()->flash('success', 'Category has been updated successfully.');
        return response('Category created !', 200);

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
    }
    public function destroy(Category $category)
    {

        $category->delete();

        return response('Success, Category has been deleted', 200);
    }
}
