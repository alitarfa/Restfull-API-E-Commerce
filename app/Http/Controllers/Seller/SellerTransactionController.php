<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $seller=Seller::findOrfail($id);
        $transactions=$seller->products()
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();
        return response()->json(['data'=>$transactions]);
    }

}
