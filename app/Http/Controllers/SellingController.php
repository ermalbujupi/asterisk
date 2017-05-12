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
            ->select('users.username as user','products.name as product','brands.name as brand','categories.name as category','sellings.quantity_sold','sellings.price_sold','sellings.created_at')
            ->join('products','products.id','=','sellings.product')
            ->join('users','users.id','=','sellings.seller')
            ->join('brands','brands.id','=','products.brand_id')
            ->join('categories','categories.id','=','products.category_id')
            ->get();

        return view('sales',['sellings'=>$sellings]);
    }
}
