<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sellings;

class SellingController extends Controller
{

    public function  getAll(){

        $sellings = Sellings::all();
        return view('sales',['sellings'=>$sellings]);
    }
}
