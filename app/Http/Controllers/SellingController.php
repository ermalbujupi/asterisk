<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sellings;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class SellingController extends Controller
{

    public function  getAll(){

        $sellings = DB::table('sellings')
            ->join('products','products.id','=','sellings.product')
            ->join('users','users.id','=','sellings.seller')
            ->join('brands','brands.id','=','products.brand_id')
            ->join('categories','categories.id','=','products.category_id')
            ->select('sellings.id','products.name as product','sellings.price_sold','sellings.quantity_sold','sellings.descripton','brands.name as brand','categories.name as category')
            ->get();

        return view('sales',['sellings'=>$sellings]);
    }
}
