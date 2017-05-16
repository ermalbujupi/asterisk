<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Brand;
use App\Category;
use App\Product;
use App\Sellings;

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
            ->where('products.system_deleted','=','0')
            ->where('brands.system_deleted','=','0')
            ->select('products.*','categories.name as category','brands.name as brand')
            ->orderBy('products.id','desc')
            ->paginate(10);

        $brands = Brand::where('system_deleted','=','0')->get();
        $categories = Category::where('system_deleted','=','0')->get();
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

    public function  getProducts(){
        $products = DB::table('products')
            ->join('categories','categories.id','=','products.category_id')
            ->join('brands','brands.id','=','products.brand_id')
            ->where('products.quantity','>','0')
            ->where('system_deleted','=','0')
            ->select('products.*','categories.name as category','brands.name as brand')
            ->get();
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
          return Response::json(['message'=>'Couldn\'t Delete Product']);
      }
   }


    public function search(Request $req){
        $word = $req['word'];

        $products = DB::table('products')
            ->join('categories','categories.id','=','products.category_id')
            ->join('brands','brands.id','=','products.brand_id')
            ->where('products.system_deleted','=','0')
            ->where('products.name','like','%'.$word.'%')
            ->select('products.*','categories.name as category','brands.name as brand ')
            ->get();

        Return Response::json(['products'=>$products],200);
    }


    public function addNewBrand(Request $req){

      $name = $req['name'];
      $info = $req['info'];

      $brand = Brand::where('name','like',$name)->first();

      if($brand != null){
          return Response::json(['message'=>'Brand with this name already exists'],400);
      }

      $brand = new Brand();
      $brand->name = $name;
      $brand->info = $info;
      $brand->system_deleted = 1;

      if($brand->save()){
        return Response::json(['message'=>'Brand Added Successfully','brand'=>$brand],200);
      }else{
        return Response::json(['message'=>'Error Adding Brand'],400);
      }
    }

    public function addNewCategory(Request $req){

      $name = $req['name'];

      $category = Category::where('name','like',$name)->first();

      if($category != null){
          return Response::json(['message'=>'Category with this name already exists'],400);
      }

      $category = new Category();
      $category->name = $name;
      $category->system_deleted = 0;

      if($category->save()){
        return Response::json(['message'=>'Category Added Successfully','category'=>$category],200);
      }else{
        return Response::json(['message'=>'Error Adding Category'],400);
      }
    }


    public function sellProduct(Request $request){

        $id = $request['id'];
        $product = Product::find($id);
        $quantity = $request['quantity'];
        $price = $request['price'];

        if($quantity > $product->quantity){
            return Response::json(["message"=>"You can't sell the product with higher quantity!"],400);
        }

        $product->quantity -= $quantity;

        if($product->quantity == 0){
            $product->system_deleted = 1;
        }

        $sell = new Sellings();
        $sell->product = $id;
        $sell->seller = Auth::user()->id;
        $sell->price_sold = $price;
        $sell->quantity_sold = $quantity;

        if($product->save()){
            if($sell->save()){
                return Response::json(['message'=>'Product Sold'],200);
            }else{
                return Response::json(['message'=>'Error Selling Product'],400);
            }
        }

    }


    public function getProductsByBrandOrCategory(Request $req){

        $brand = $req['brand'];
        $category = $req['category'];

        $products = null;

        if(isset($brand) && isset($category) && $brand != '' && $category != ''){
            $products = DB::table('products')
                ->select('products.*','categories.name as category','brands.name as brand')
                ->join('categories','categories.id','=','products.category_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->where('brands.name','=',$brand)
                ->where('categories.name','=',$category)
                ->get();

        }else if(isset($brand) && $brand != ''){
            $products = DB::table('products')
                ->select('products.*','categories.name as category','brands.name as brand')
                ->join('categories','categories.id','=','products.category_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->where('brands.name','=',$brand)
                ->get();

        }else if(isset($category) && $category != ''){
            $products = DB::table('products')
                ->select('products.*','categories.name as category','brands.name as brand')
                ->join('categories','categories.id','=','products.category_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->where('categories.name','=',$category)
                ->get();
        }

        return Response::json(['products'=>$products],200);
    }

    public function getAll(){
        $products = DB::table('products')
            ->join('categories','categories.id','=','products.category_id')
            ->join('brands','brands.id','=','products.brand_id')
            ->where('products.quantity','>','0')
            ->where('products.system_deleted','=','0')
            ->where('brands.system_deleted','=','0')
            ->select('products.*','categories.name as category','brands.name as brand')
            ->orderBy('products.id','desc')->get();

        return Response::json(['products'=>$products],200);
    }


}
