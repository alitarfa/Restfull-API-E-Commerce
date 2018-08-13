<?php

namespace App\Http\Controllers\Categories;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategorySellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $categories=Category::findOrFail($id);
        $result=$categories->product()->with('seller')->get()->pluck('seller')->unique('id')->values();
        return $this->showAll($result);

    }





}
