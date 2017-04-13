<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Brand;
use App\Category;
use App\Product;

class StockController extends Controller
{
    public function getPage(){
      //return view('stock');
    }

    public function getAllProducts(){
        $products = DB::table('products')->join('categories','categories.id','=','products.category_id')->join('brands','brands.id','=','products.brand_id')->where('products.quantity','>','0')->select('products.*','categories.name as category','brands.name as brand')->get();
        $brands = Brand::all();
        $categories = Category::all();
        return view('stock',['products'=>$products,'brands'=>$brands,'categories'=>$categories]);
    }

    public function saveProduct(Request $request)
    {
        $product = new Product();
        $product->name = $request['name'];
        $product->category_id = $request['category'];
        if($request['category']==3){
            $product->brand_id=null;
            $product->imei=null;
        }
        else
        {
            $product->brand_id=$request['brand'];
            $product->imei=$request['imei'];
        }
        $product->quantity=$request['quantity'];
        $product->price = $request['price'];
        $product->description= $request['description'];
        $product->system_deleted = "0";
        if($product->save())
        {
            return Response::json(['message'=>'Product Added'],200);
        }
        return Response::json(['message'=>'Error'],400);
    }
}
