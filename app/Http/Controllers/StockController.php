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
use App\Payment;
use App\ProductPayment;


class StockController extends Controller
{
    public function getPage(){
      //return view('stock');
    }

    public function getAllProducts(){
        $products = DB::table('products')
                ->select('categories.name as category',DB::raw('sum(products.quantity) as nr'))
                ->join('categories','categories.id','=','products.category_id')
                ->where('products.system_deleted','=','0')
                ->groupBy('categories.name')
                ->get();

        $brands = Brand::where('system_deleted','=','0')->get();
        $categories = Category::where('system_deleted','=','0')->get();
        return view('stock',['products'=>$products,'brands'=>$brands,'categories'=>$categories]);
    }

    public function getProductsName(){

        $products = DB::table('products')
        ->select('products.*','brands.name as brand','categories.name as category')
        ->join('brands','brands.id','=','products.brand_id')
        ->join('categories','categories.id','=','products.category_id')
        ->where('products.system_deleted','=','0')
        ->get();

        return Response::json(['products'=>$products],200);
    }

    public function saveProduct(Request $request)
    {
        $name = $request['name'];
        $product = Product::where('name',$name)->first();

        if($product == null){
            $product = new Product();
            $product->name = $request['name'];
            $product->category_id = $request['category'];
            if($request['category']==3){
                $product->brand_id=null;
            }
            else
            {
                $product->brand_id=$request['brand'];
            }
            $product->quantity=$request['quantity'];
            $product->price = $request['price'];
            $product->price_sold = $request['sell_price'];
            $product->description= $request['description'];
            $product->system_deleted = "0";
            if($product->save())
            {
                $brand = Brand::find($product->brand_id);
                $category = Category::find($product->category_id);
                return Response::json(['message'=>'Product Added','product'=>$product,'brand'=>$brand,'category'=>$category],200);
            }else{
                return Response::json(['message'=>'Error Adding Product'],400);
            }
        }else{
            $product->quantity += $request['quantity'];

            if($product->save()){
                return Response::json(['message'=>'Product Added','product'=>$product,'brand'=>(Brand::find($product->brand_id)),'category'=>(Category::find($product->category_id))]);
            }else{
                return Response::json(['message'=>'Error Adding Product'],400);
            }
        }

    }

    public function getProduct(Request $request){
       $id = $request['product_id'];
       $product = Product::find($id);
       return Response::json(['product'=>$product],200);
    }


    private function filterSearch($category,$brand,$word){

        if(isset($brand) && isset($category) && $category >0 && $brand > 0){
            $products = DB::table('products')
                ->join('categories','categories.id','=','products.category_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->where('products.quantity','>','0')
                ->where('products.system_deleted','=','0')
                ->where('categories.id','=',$category)
                ->where('brands.id','=',$brand)
                ->where('products.name','like','%'.($word == null ? '':$word).'%')
                ->select('products.*','categories.name as category','brands.name as brand')
                ->get();

        }else if(isset($brand) && $brand > 0){
            $products = DB::table('products')
                ->join('categories','categories.id','=','products.category_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->where('products.quantity','>','0')
                ->where('products.system_deleted','=','0')
                ->where('brands.id','=',$brand)
                ->where('products.name','like','%'.($word == null ? '':$word).'%')
                ->select('products.*','categories.name as category','brands.name as brand')
                ->get();

        }else if(isset($category) && $category > 0){
            $products = DB::table('products')
                ->join('categories','categories.id','=','products.category_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->where('products.quantity','>','0')
                ->where('products.system_deleted','=','0')
                ->where('categories.id','=',$category)
                ->where('products.name','like','%'.($word == null ? '':$word).'%')
                ->select('products.*','categories.name as category','brands.name as brand')
                ->get();
        }else{
            $products = DB::table('products')
                ->join('categories','categories.id','=','products.category_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->where('products.quantity','>','0')
                ->where('products.system_deleted','=','0')
                ->where('products.name','like','%'.($word == null ? '':$word).'%')
                ->select('products.*','categories.name as category','brands.name as brand')
                ->get();
        }

        return $products;
    }

    public function  getProducts($category,$brand){

        $products =  $this->filterSearch($brand,$category,'');

        return Response::json(['products'=>$products],200);
    }


    public function editProduct(Request $request){
       $id = $request['id'];
       $product = Product::find($id);
       $product->name = $request['name'];
       $product->category_id = $request['category'];
       $product->brand_id = $request['brand'];
       $product->price = $request['price'];
       $product->quantity = $request['quantity'];
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
        $brand = $req['brand'];
        $category = $req['category'];

        $products = $this->filterSearch($category,$brand,$word);

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

         $products = explode(',', $request['products']);

        $sold = false;
        //productsSell[i].id+';'+productsSell[i].price_sold+';'+productsSell[i].quantity
         foreach($products as $productString){

             $fields = explode(';',$productString);
             $id = ((int)$fields[0]);
             $product = Product::find($id);
             $quantity_sold =(int)$fields[2];
             $price_sold = (float)$fields[1];

             if($quantity_sold > $product->quantity){
                 return Response::json(["message"=>"You can't sell the product with higher quantity!"],400);
             }

             $product->quantity -= $quantity_sold;
            if($product->quantity == 0){
                $product->system_deleted = 1;
            }

           $product->save();

            $payment = new Payment();
            $payment->price_sold = $price_sold;
            $payment->quantity_sold = $quantity_sold;
            $payment->user_id = Auth::user()->id;
            $payment->save();

            $product_payment = new ProductPayment();
            $product_payment->product_id = $product->id;
            $product_payment->payment_id = $payment->id;

            if($product_payment->save()){
                $sold = true;
            }
         }

         if($sold){
             return Response::json(['message'=>'All Products have benn sold successfully!'],200);
         }else{
             return Response::json(['message'=>'Products failed saving!']);
         }


    }


    public function getProductsByBrandOrCategory(Request $req){

        $brand = $req['brand'];
        $category = $req['category'];
        $products = $this->filterSearch($category,$brand,'');
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
