<?php

namespace Inovector\ProductManager\Http\Controllers;

use Inovector\ProductManager\Models\Seller;
use Illuminate\Routing\Controller;

class SellerController extends Controller
{
    public function index()
    {
        return response()->json(Seller::all());
    }
}
