<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['main_menu_title'] = "Product Management";
        $data['sub_menu_title'] = "Viewing all Products";
        $data['products'] = Product::orderBy('id', 'desc');

        if ($request->first_name != '') {
            $data['users']->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->last_name != '') {
            $data['users']->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->date_from != '') {
            $data['users']->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($request->date_from)));
        }
        if ($request->date_to != '') {
            $data['users']->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime($request->date_to)));
        }

        if ($request->city_id != '') {
            $data['users']->where('city_id', '=', $request->city_id);
        }

        $data['products'] = $data['products']->cursorPaginate(100);

        return view('backend.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['main_menu_title'] = "Product Management";
        $data['sub_menu_title'] = "Add Product";
        $data['categories'] = Category::all();
        $data['brands'] = Brand::all();
        return view('backend.products.form',$data);
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
            'name' => 'required|unique:products|max:255',
            'category_id' => 'required|integer',
            'brand_id' => 'nullable|integer',
            'standard' => 'required|numeric',
            'premium' => 'required|numeric',
            'gold' => 'required|numeric',
            'measuring_unit' => 'nullable|string',
            'weight' => 'nullable|numeric',
            'product_image' => 'required|image',
            'description' => 'nullable|max:255',
        ];

        $this->validate($request, $rules);

        $product= new Product();
        $colors = [];
        if ($request->is_colored == 'on') {
            if ($request->colors != null) {
                foreach ($request->colors as $key=>$value) {
                    if ($request->hasFile('color_img')) {
                        $colorfilename = 'product-' . time() . rand(99, 199) . '.' . $request->file('color_img')[$key]->getClientOriginalExtension();
                        $request->file('color_img')[$key]->move('products/', $colorfilename);
                    }
                    $colors[$value] = $colorfilename;
                }
            }
        }
        $product->is_colored = $request->is_colored=='on' ?1 :0;
        $product->color = $product->setColors($colors);
        $product->name = $request->name;
        $product->measuring_unit = $request->measuring_unit;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->standard = $request->standard;
        $product->premium = $request->premium;
        $product->gold = $request->gold;
        $product->gold = $request->gold;
        $product->description = $request->description;
        $product->weight = $request->weight;
        $product->product_image = $request->weight;
        $product->status = $request->status=='on' ? :1  ;
        $product->in_stock = $request->in_stock=='on' ? :1  ;
        $product->is_featured = $request->is_featured=='on' ? :1  ;
        $product->size = $request->size;
        $product->created_by = Auth::user()->id;
        if ($request->hasFile('product_image')) {
            $filename = 'product-' . time() . rand(99, 199) . '.' . $request->file('product_image')->getClientOriginalExtension();
            $request->file('product_image')->move('products/', $filename);
        }
        if (isset($filename)) {
            $product->product_image = $filename;
        }
        $product->save();

        return redirect('adminpanel/products')->with('success', 'Product has been added successfully.');
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
    public function edit(Product $product)
    {
        $data['main_menu_title'] = "Product Management";
        $data['sub_menu_title'] = "Modify Product";
        $data['categories'] = Category::all();
        $data['brands'] = Brand::all();
        $data['product'] = $product;
        return view('backend.products.form',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required|unique:products,name,' . $product->id,
            'category_id' => 'required|integer',
            'brand_id' => 'nullable|integer',
            'standard' => 'required|numeric',
            'premium' => 'required|numeric',
            'gold' => 'required|numeric',
            'measuring_unit' => 'nullable|string',
            'weight' => 'nullable|numeric',
            'description' => 'nullable|max:1000',
            'product_image' => 'image'
        ];
        $colors = [];
        if ($request->is_colored == 'on') {
            if ($request->colors != null) {
                foreach ($request->colors as $key=>$value) {
                    if ($request->hasFile('color_img')) {
                        $colorfilename = 'product-' . time() . rand(99, 199) . '.' . $request->file('color_img')[$key]->getClientOriginalExtension();
                        $request->file('color_img')[$key]->move('products/', $colorfilename);
                    }
                    $colors[$value] = $colorfilename;
                }
            }
        }
        $this->validate($request, $rules);
        $product->name = $request->name;
        $product->is_colored = $request->is_colored=='on' ?1 :0;
        $product->color = $product->setColors($colors);
        $product->measuring_unit = $request->measuring_unit;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->standard = $request->standard;
        $product->premium = $request->premium;
        $product->gold = $request->gold;
        $product->description = $request->description;
        if ($request->hasFile('product_image')) {
            if (!empty($product->product_image)) {
                $file =  'products/' . $product->product_image;
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            $filename = 'product-' . time() . rand(99, 199) . '.' . $request->file('product_image')->getClientOriginalExtension();
            $request->file('product_image')->move('products/', $filename);
        }

        if (isset($filename)) {
            $product->product_image = $filename;
        }
        $product->weight = $request->weight;
        $status=0;
        $in_stock=0;
        $featured=0;
        if($request->status=='on'){
            $status=1;
        }
        if($request->in_stock=='on'){
            $in_stock=1;
        }
        if($request->is_featured=='on'){
            $featured=1;
        }
        $product->status = $status ;
        $product->in_stock = $in_stock ;
        $product->is_featured = $featured ;
        $product->size = $request->size;
        $product->created_by = Auth::user()->id;
        $product->save();

        return redirect('adminpanel/products')->with('success', 'Product has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response('Success, Product has been deleted', 200);
    }
}
