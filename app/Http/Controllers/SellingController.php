<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Sellings;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class SellingController extends Controller
{

    public function getAll(){

        $sellings = DB::table('sellings')
            ->select('sellings.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','sellings.quantity_sold','sellings.price_sold','sellings.created_at')
            ->join('products','products.id','=','sellings.product')
            ->join('users','users.id','=','sellings.seller')
            ->join('brands','brands.id','=','products.brand_id')
            ->join('categories','categories.id','=','products.category_id')
            ->whereDate('sellings.created_at','=',date('Y-m-d'))
            ->orderBy('sellings.id','desc')
            ->get();

        $users =  User::all();

        return view('sales',['sellings'=>$sellings,'users'=>$users]);
    }

    public function getSales(){

        $sellings = DB::table('sellings')
            ->select('sellings.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','sellings.quantity_sold','sellings.price_sold','sellings.created_at')
            ->join('products','products.id','=','sellings.product')
            ->join('users','users.id','=','sellings.seller')
            ->join('brands','brands.id','=','products.brand_id')
            ->join('categories','categories.id','=','products.category_id')
            ->whereDate('sellings.created_at','=',date('Y-m-d'))
            ->orderBy('sellings.id','desc')
            ->get();

        return Response::json(['sales'=>$sellings],200);
    }

    public function filterDate($date){

        $sellings = DB::table('sellings')
            ->select('sellings.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','sellings.quantity_sold','sellings.price_sold','sellings.created_at')
            ->join('products','products.id','=','sellings.product')
            ->join('users','users.id','=','sellings.seller')
            ->join('brands','brands.id','=','products.brand_id')
            ->join('categories','categories.id','=','products.category_id')
            ->whereDate('sellings.created_at','=',$date)
            ->orderBy('sellings.id','desc')
            ->get();

        return Response::json(['sales'=>$sellings],200);
    }

    public function filterUser($user){


        $sellings = DB::table('sellings')
            ->select('sellings.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','sellings.quantity_sold','sellings.price_sold','sellings.created_at')
            ->join('products','products.id','=','sellings.product')
            ->join('users','users.id','=','sellings.seller')
            ->join('brands','brands.id','=','products.brand_id')
            ->join('categories','categories.id','=','products.category_id')
            ->where('users.id','=',$user)
            ->orderBy('sellings.id','desc')
            ->get();

        return Response::json(['sales'=>$sellings],200);
    }
}
