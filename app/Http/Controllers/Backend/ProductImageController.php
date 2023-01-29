<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        view()->share('breadcrumbs', [['url' => config('constants.ADMIN') . 'products', 'title' => 'Manage Products']]);
        $data['product'] = Product::findOrFail($id);
        view()->share('page_title', 'viewing pics for ' .$data['product']->name);
        $data['images'] = $data['product']->ProductImages()->orderBy('id', 'desc')->paginate();

        return view('backend.products.product-images', $data);
    }
    public function store(Request $request)
    {

        if ($request->hasFile('file')) {
            $filename = 'product-' .time() . '-' . mt_rand(1, 99) . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move('products/dropzone', $filename);


            $item = new ProductImage;
            $item->image_url = $filename;
            $item->product_id = $request->product_id;
            $item->save();
            $response = ['error' => false, 'message' => 'Successfully uploaded.'];
        } else {
            $response = ['error' => true, 'message' => 'File not uploaded.'];
        }
        return response()->json($response);
    }
    public function destroy($id,$image_id)
    {


        $product = ProductImage::findOrFail($image_id);
        if (!empty($product)){
            $file = 'products/dropzone/' . $product->image_url;
            if (file_exists($file)) {
                unlink($file);
            }
        }

        $product->delete();
        return response('Success, Product has been deleted', 200);
    }
}
