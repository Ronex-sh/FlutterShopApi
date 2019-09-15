<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
      
        $products=Product::with(['category','images'])->paginate(env('PAGINATION_COUNT'));
        $currnecyCode=env('CURRENCY_CODE','$');
       
       
       return view('admin.products.products')->with
       (['products'=>$products,'currence_code'=>$currnecyCode]);
    }
}
