<?php

namespace App\Http\Controllers;
use App\Http\Requests;
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
        $products = DB::table('products')
            ->join('categories','categories.id','=','products.category_id')
            ->join('brands','brands.id','=','products.brand_id')
            ->where('products.quantity','>','0')
            ->where('system_deleted','=','0')
            ->select('products.*','categories.name as category','brands.name as brand')
            ->get();

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
           $brand = Brand::find($product->brand_id);
           $category = Category::find($product->category_id);
            return Response::json(['message'=>'Product Added','product'=>$product,'brand'=>$brand,'category'=>$category],200);
        }
        return Response::json(['message'=>'Error'],400);
    }

    public function getProduct(Request $request){
       $id = $request['product_id'];
       $product = Product::find($id);
       return Response::json(['product'=>$product],200);
   }

    public function editProduct(Request $request){
       $id = $request['id'];
       $product = Product::find($id);
       $product->name = $request['name'];
       $product->category_id = $request['category'];
       $product->brand_id = $request['brand'];
       $product->price = $request['price'];
       $product->quantity = $request['quantity'];
       $product->imei = $request['imei'];
       $product->description = $request['description'];
       if($product->save()){
           $brand =  Brand::find($product->brand_id);
           $category = Category::find($product->category_id);
           return Response::json(['message'=>'Product Edited','product'=>$product,'brand'=>$brand,'category'=>$category]);
       }
       else{
           return Response::json(['message'=>'Error Product editing']);
       }

   }


   public function deleteProduct(Request $req){
      $id  = $req['id'];
      $product = Product::find($id);
      $product->system_deleted = 1;
      if($product->save()){
          return Response::json(['message'=>'Product Successfully Deleted']);
      }else{
          return Response::json(['message'=>'Couldn\'t Delet Product']);
      }
  }


}
