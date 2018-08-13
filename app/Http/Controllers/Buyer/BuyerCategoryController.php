<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class BuyerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $buyer=Buyer::findOrFail($id);
        // give me the product of the buyer
        $result_data=$buyer->transactions()
            ->with('product.categories')
            ->get()
            ->pluck('product.categories')
            ->unique('id')
            ->values()
            ->collapse();
        return response()->json(['data'=>$result_data]);
    }


}
