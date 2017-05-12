<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatBrandsController extends Controller
{
    public function getAll(){
        $brand = DB::table('brands')->select('brands.*')->where('system_deleted','=','0')->paginate(10);
        $categories = DB::table('categories')->select('categories.*')->where('system_deleted','=','0')->paginate(10);

        return view('categoriesbrands',['brands'=>$brand,'categories'=>$categories]);
    }

    public function findBrand(Request $req){
        $brand = Brand::find($req['id']);

        if($brand !=  null){
            return Response::json(['brand'=>$brand],200);
        }
    }

    public function findCategory(Request $req){
        $category = Category::find($req['id']);

        if($category !=  null){
            return Response::json(['category'=>$category],200);
        }
    }

    public function editCategory(Request $req){
        $category = Category::find($req['id']);

        $category->name =$req['name'];

        if($category->save()){
            return Response::json(['message'=>'Category Successfully Edited','category'=>$category],200);
        }else {
            return Response::json(['message' => 'Error Editing Category'], 400);
        }
    }

    public function editBrand(Request $req){
        $brand = Brand::find($req['id']);

        $brand->name = $req['name'];
        $brand->info = $req['info'];

        if($brand->save()){
            return Response::json(['message'=>'Brand Successfully Edited','brand'=>$brand],200);
        }else {
            return Response::json(['message' => 'Error Editing Brand'], 400);
        }

    }

    public function deleteBrand(Request $req){
        $brand = Brand::find($req['id']);

        $in_use = DB::table('products')
            ->where('products.brand_id','=',$brand->id)
            ->where('products.system_deleted','=','0')
            ->first();

        if($in_use ==  null){

            $brand->system_deleted = 1;
            if($brand->save()) {
                return Response::json(['message' => 'Brand Deleted Successfully'], 200);
            }else{
                return Response::json(["message"=>"Couldn't Delete Brand"],400);
            }
        }else{
            return Response::json(["message"=>"Brand Currently in use"],400);
        }
    }

    public function deleteCategory(Request $req){
        $category = Category::find($req['id']);

        $in_use = DB::table('products')
            ->where('products.category_id','=',$category->id)
            ->where('products.system_deleted','=','0')
            ->first();

        if($in_use ==  null){

            $category->system_deleted = 1;
            if($category->save()) {
                return Response::json(['message' => 'Category Deleted Successfully'], 200);
            }else{
                return Response::json(["message"=>"Couldn't Delete Category"],400);
            }
        }else{
            return Response::json(["message"=>"Category Currently in use"],400);
        }
    }
}
