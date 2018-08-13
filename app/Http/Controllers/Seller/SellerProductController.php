<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Product;
use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $seller=Seller::findOrfail($id);
        $products=$seller->products;
        return response()->json(['data'=>$products]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Seller $seller)
    {

        $product=new Product();
        $product['name'] =$request->name;
        $product['description'] =$request->description;
        $product['quantity'] =$request->quantity;
        $product['status'] =Product::UNAVAILABLE_PRODUCT;
        $product['seller_id'] =$seller->id;
        $product['image'] =$request->image->store('path');
        $product->save();

       return $this->showOne($product,200);

    }

}
