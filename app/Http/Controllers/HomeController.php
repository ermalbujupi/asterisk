<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Statistics;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function getIndex()
    {

        return view('index');
    }


    public function getUserStats(){

        $date = DB::table('users')
            ->select(DB::raw("DATE_FORMAT(users.created_at,'%d-%m-%Y') as date"))
            ->groupBy(DB::raw("DATE_FORMAT(users.created_at,'%d-%m-%Y')"))
            ->get();



        $array = [];

        foreach($date as $d){

            $count  =  DB::table('users')->whereRaw("DATE_FORMAT(users.created_at,'%d-%m-%Y') like '".$d->date."%'")->count();
            $stats =  new Statistics($d->date,$count);


            array_push($array,$stats);
        }

        return Response::json(['stats'=>$array],200);
    }


}
