<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Input;
class ProductControllerApi extends Controller
{
    public function product_list($category_id = null)
    {
        if($category_id)
        {
            $products = Product::where('category_id', $category_id)->get();
        }
        else
        {
            $products = Product::all();
        }
        return response()->json(array(
            'ok' => true,
            'products' => $products,
        ));
    }
    public function product_search()
    {
        $query = Input::get('query');
        if($query)
        {
            $products = Product::where('code','like','%'.$query.'%')->orWhere('name','like','%'.$query.'%')->get();
        }
        else
        {
            $products = Product::all;
        }
        return response()->json(array(
            'ok' => true,
            'products' => $products,
        ));
    }
}
