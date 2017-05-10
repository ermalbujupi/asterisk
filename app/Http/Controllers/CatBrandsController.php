<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class CatBrandsController extends Controller
{
    public function getAll(){
        $brand = Brand::all();
        $categories = Category::all();

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
}
