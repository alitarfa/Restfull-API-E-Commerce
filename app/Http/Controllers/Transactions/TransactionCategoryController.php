<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\ApiController;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      $categories=Transaction::findOrFail($id)->product->categories;
      return $this->showAll($categories);
    }


}
