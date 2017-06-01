<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Excel;
class SellingController extends Controller
{

    public function getAll(){

        $sellings = DB::table('payments')
            ->select('payments.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','payments.quantity_sold','payments.price_sold',DB::raw('DATE_FORMAT(payments.created_at, "%d-%m-%Y %h:%m:%s") as created_at'))
            ->join('product_payment','product_payment.payment_id','=','payments.id')
            ->join('products','products.id','=','product_payment.product_id')
            ->join('users','users.id','=','payments.user_id')
            ->join('brands','brands.id','=','products.brand_id')
            ->join('categories','categories.id','=','products.category_id')
            ->whereDate('payments.created_at','=',date('Y-m-d'))
            ->orderBy('payments.id','desc')
            ->get();

        $users =  User::all();




        return view('sales',['sellings'=>$sellings,'users'=>$users]);
    }

    public function getSales(){

        $sellings = DB::table('payments')
            ->select('payments.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','payments.quantity_sold','payments.price_sold',DB::raw('DATE_FORMAT(payments.created_at, "%d-%m-%Y %h:%m:%s") as created_at'))
            ->join('product_payment','product_payment.payment_id','=','payments.id')
            ->join('products','products.id','=','product_payment.product_id')
            ->join('users','users.id','=','payments.user_id')
            ->join('brands','brands.id','=','products.brand_id')
            ->join('categories','categories.id','=','products.category_id')
            ->whereDate('payments.created_at','=',date('Y-m-d'))
            ->orderBy('payments.id','desc')
            ->get();

        return Response::json(['sales'=>$sellings],200);
    }

    private function filterSearch($user,$year,$month,$date){
        $sellings =  null;
        if($user != 0 && $year !=0 && $month != 0 ){
            $sellings = DB::table('payments')
                ->select('payments.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','payments.quantity_sold','payments.price_sold',DB::raw('DATE_FORMAT(payments.created_at, "%d-%m-%Y %h:%m:%s") as created_at'))
                ->join('product_payment','product_payment.payment_id','=','payments.id')
                ->join('products','products.id','=','product_payment.product_id')
                ->join('users','users.id','=','payments.user_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->join('categories','categories.id','=','products.category_id')
                ->whereMonth('payments.created_at','=',$month)
                ->whereYear('payments.created_at','=',$year)
                ->where('users.id','=',$user)
                ->orderBy('payments.id','desc')
                ->get();

        }else if($user != 0 && $year !=0){
            $sellings = DB::table('payments')
                ->select('payments.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','payments.quantity_sold','payments.price_sold',DB::raw('DATE_FORMAT(payments.created_at, "%d-%m-%Y %h:%m:%s") as created_at'))
                ->join('product_payment','product_payment.payment_id','=','payments.id')
                ->join('products','products.id','=','product_payment.product_id')
                ->join('users','users.id','=','payments.user_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->join('categories','categories.id','=','products.category_id')
                ->whereYear('payments.created_at','=',$year)
                ->where('users.id','=',$user)
                ->orderBy('payments.id','desc')
                ->get();
        }else if($user != 0 && $month !=0){
            $sellings = DB::table('payments')
                ->select('payments.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','payments.quantity_sold','payments.price_sold',DB::raw('DATE_FORMAT(payments.created_at, "%d-%m-%Y %h:%m:%s") as created_at'))
                ->join('product_payment','product_payment.payment_id','=','payments.id')
                ->join('products','products.id','=','product_payment.product_id')
                ->join('users','users.id','=','payments.user_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->join('categories','categories.id','=','products.category_id')
                ->whereMonth('payments.created_at','=',$month)
                ->where('users.id','=',$user)
                ->orderBy('payments.id','desc')
                ->get();
        }else if($user != 0 && $date !=0){
            $sellings = DB::table('payments')
                ->select('payments.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','payments.quantity_sold','payments.price_sold',DB::raw('DATE_FORMAT(payments.created_at, "%d-%m-%Y %h:%m:%s") as created_at'))
                ->join('product_payment','product_payment.payment_id','=','payments.id')
                ->join('products','products.id','=','product_payment.product_id')
                ->join('users','users.id','=','payments.user_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->join('categories','categories.id','=','products.category_id')
                ->whereDate('payments.created_at','=',$date)
                ->where('users.id','=',$user)
                ->orderBy('payments.id','desc')
                ->get();
        }else if($user != 0){
            $sellings = DB::table('payments')
                ->select('payments.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','payments.quantity_sold','payments.price_sold',DB::raw('DATE_FORMAT(payments.created_at, "%d-%m-%Y %h:%m:%s") as created_at'))
                ->join('product_payment','product_payment.payment_id','=','payments.id')
                ->join('products','products.id','=','product_payment.product_id')
                ->join('users','users.id','=','payments.user_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->join('categories','categories.id','=','products.category_id')
                ->where('users.id','=',$user)
                ->orderBy('payments.id','desc')
                ->get();
        }else if($year != 0 && $month !=0){
            $sellings = DB::table('payments')
                ->select('payments.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','payments.quantity_sold','payments.price_sold',DB::raw('DATE_FORMAT(payments.created_at, "%d-%m-%Y %h:%m:%s") as created_at'))
                ->join('product_payment','product_payment.payment_id','=','payments.id')
                ->join('products','products.id','=','product_payment.product_id')
                ->join('users','users.id','=','payments.user_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->join('categories','categories.id','=','products.category_id')
                ->whereMonth('payments.created_at','=',$month)
                ->whereYear('payments.created_at','=',$year)
                ->orderBy('payments.id','desc')
                ->get();
        }else if($year != 0){
            $sellings = DB::table('payments')
                ->select('payments.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','payments.quantity_sold','payments.price_sold',DB::raw('DATE_FORMAT(payments.created_at, "%d-%m-%Y %h:%m:%s") as created_at'))
                ->join('product_payment','product_payment.payment_id','=','payments.id')
                ->join('products','products.id','=','product_payment.product_id')
                ->join('users','users.id','=','payments.user_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->join('categories','categories.id','=','products.category_id')
                ->whereYear('payments.created_at','=',$year)
                ->orderBy('payments.id','desc')
                ->get();
        }
        else if($month != 0){
            $sellings = DB::table('payments')
                ->select('payments.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','payments.quantity_sold','payments.price_sold',DB::raw('DATE_FORMAT(payments.created_at, "%d-%m-%Y %h:%m:%s") as created_at'))
                ->join('product_payment','product_payment.payment_id','=','payments.id')
                ->join('products','products.id','=','product_payment.product_id')
                ->join('users','users.id','=','payments.user_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->join('categories','categories.id','=','products.category_id')
                ->whereMonth('payments.created_at','=',$month)
                ->orderBy('payments.id','desc')
                ->get();
        }else if($date != 0){
            $sellings = DB::table('payments')
                ->select('payments.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','payments.quantity_sold','payments.price_sold',DB::raw('DATE_FORMAT(payments.created_at, "%d-%m-%Y %h:%m:%s") as created_at'))
                ->join('product_payment','product_payment.payment_id','=','payments.id')
                ->join('products','products.id','=','product_payment.product_id')
                ->join('users','users.id','=','payments.user_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->join('categories','categories.id','=','products.category_id')
                ->whereDate('payments.created_at','=',$date)
                ->orderBy('payments.id','desc')
                ->get();
        }else{
            $sellings = DB::table('payments')
                ->select('payments.id','users.username as user','products.name as product','brands.name as brand','categories.name as category','payments.quantity_sold','payments.price_sold',DB::raw('DATE_FORMAT(payments.created_at, "%d-%m-%Y %h:%m:%s") as created_at'))
                ->join('product_payment','product_payment.payment_id','=','payments.id')
                ->join('products','products.id','=','product_payment.product_id')
                ->join('users','users.id','=','payments.user_id')
                ->join('brands','brands.id','=','products.brand_id')
                ->join('categories','categories.id','=','products.category_id')
                ->orderBy('payments.id','desc')
                ->get();
        }
            return $sellings;
    }

    public function salesFilter($user,$year,$month,$date){

        $sellings = $this->filterSearch($user,$year,$month,$date);
        return Response::json(['sellings'=>$sellings],200);
    }

    public function exportToExcel($user,$year,$month,$date){
        $sellings = $this->filterSearch($user,$year,$month,$date);

        $paymentsArray[] = ['ID', 'User','Product Name','Brand','Category','Quantity','Price Sold','Date Sold'];

        foreach($sellings as $sell){
            $paymentsArray[] = (array)$sell;
        }

        $file_name = ('payments_'.date('m_d_Y_h_i_s ', time()));

        Excel::create($file_name, function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Payments');
            $excel->setCreator('Laravel')->setCompany('W    J Gilmore, LLC');
            $excel->setDescription('payments file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->store('xlsx',storage_path().'\\reports\\excel');

        return Response::json(['file'=>($file_name.'.xlsx')],200);
    }

    public function downloadExcelFile($file){
        return response()->download(storage_path().'\\reports\\excel\\'.$file);
    }

    public function downloadPdfFile($file){
        return response()->download(storage_path().'\\reports\\pdf\\'.$file);
    }

    public function exportToPDF($user,$year,$month,$date){
        $sellings = $this->filterSearch($user,$year,$month,$date);

        $paymentsArray[] = ['ID', 'User','Product Name','Brand','Category','Quantity','Price Sold','Date Sold'];

        foreach($sellings as $sell){
            $paymentsArray[] = (array)$sell;
        }

        $file_name = ('payments_'.date('m_d_Y_h_i_s ', time()));

        Excel::create($file_name, function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Payments');
            $excel->setCreator('Laravel')->setCompany('W    J Gilmore, LLC');
            $excel->setDescription('payments file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->store('pdf',storage_path().'\\reports\\pdf');

        return Response::json(['file'=>($file_name.'.pdf')],200);
    }




}
