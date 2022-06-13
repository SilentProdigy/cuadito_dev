<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // PRODUCT LISTING PAGE
    public function index()
    {
        return view('product_listing');
    }
}
