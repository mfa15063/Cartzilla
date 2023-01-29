<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Offer;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['main_menu_title'] = "Offer Management";
        $data['sub_menu_title'] = "Viewing all Offers";
        $data['offers'] = Offer::all();
        return view('backend.offers.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['products'] = Product::orderBy('id', 'desc')->get();

        return view('backend.offers.form' , $data);
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
            'name' => 'required|unique:offers|min:2|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|min:6',
            'offer_image' => 'required|image',
            'product_id' => 'required'
        ];
        $val = [
            'product_id.required' => "Product is required"
        ];
        $this->validate($request, $rules , $val);
        $offer= new Offer();
        $offer->name = $request->name;
        $offer->price = $request->price;
        $offer->product_id = $request->product_id;
        $offer->description = $request->description;
        if ($request->hasFile('offer_image')) {
            $filename = 'offer-' . time() . rand(99, 199) . '.' . $request->file('offer_image')->getClientOriginalExtension();
            $request->file('offer_image')->move('products/', $filename);
        }
        if (isset($filename)) {
            $offer->offer_image = $filename;
        }
        $offer->save();

        $request->session()->flash('success', 'Offer has been added successfully.');
        return response('offer created !', 200);
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
    public function edit(Offer $offer)
    {
        $data['offer'] = $offer;
        $data['products'] = Product::orderBy('id', 'desc')->get();
        return view('backend.offers.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $rules = [
            'name' => 'required|unique:offers,name,' . $offer->id,
            'price' => 'required|numeric',
            'description' => 'required|string|min:6',
            'product_id' => 'required',

        ];
        $val = [
            'product_id.required' => "Product is required"
        ];

        $this->validate($request, $rules , $val);
        $offer->name = $request->name;
        $offer->price = $request->price;
        $offer->product_id = $request->product_id;
        $offer->description = $request->description;
        if ($request->hasFile('offer_image')) {
            if (!empty($offer->offer_image)) {

                $file =  'products/' . $offer->offer_image;
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            $filename = 'offer-' . time() . rand(99, 199) . '.' . $request->file('offer_image')->getClientOriginalExtension();
            $request->file('offer_image')->move('products/', $filename);
        }

        if (isset($filename)) {
            $offer->offer_image = $filename;
        }
        $offer->save();

        $request->session()->flash('success', 'Offer has been updated successfully.');
        return response('offer created !', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        if (!empty($offer->offer_image)) {

            $file =  'products/' . $offer->offer_image;
            if (file_exists($file)) {
                unlink($file);
            }
        }
        $offer->delete();
        return response('Success, Category has been deleted', 200);
    }
}
