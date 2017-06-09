<?php

namespace App\Http\Controllers;
date_default_timezone_set('Europe/Belgrade');
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
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


        $yyear = date('m/d/Y H:II',time());
        $file_name = ('payments_'.date('m_d_Y', time()));

        Excel::load('templates\\template.xlsx',function($excel) use($sellings,$yyear){

            $excel->sheet('Report',function($sheet) use($sellings,$yyear){

                $sheet->setCellValue('B1',$yyear);
                $count = 3;
                $total = 0.0;
                foreach($sellings as $sell){
                    $sheet->setCellValue('A'.$count,$sell->user);
                    $sheet->setCellValue('B'.$count,$sell->product);
                    $sheet->setCellValue('C'.$count,$sell->brand);
                    $sheet->setCellValue('D'.$count,$sell->category);
                    $sheet->setCellValue('E'.$count,$sell->quantity_sold);
                    $sheet->setCellValue('F'.$count,$sell->price_sold);
                    $sheet->setCellValue('G'.$count,$sell->created_at);
                    $total += $sell->price_sold*$sell->quantity_sold;
                    $count++;
                }


                $sheet->cell('G'.($count+1),function($cell) use($total){
                    $cell->setFontSize(12);
                    $cell->setFontWeight('bold');
                    $cell->setValue('Total:'.$total);
                });
            });
        })->setFileName($file_name)->store('xlsx',storage_path().'\\reports\\excel');




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


        $yyear = date('m/d/Y h:i',time());
        $file_name = ('payments_'.date('m_d_Y', time()));

        Excel::load('templates\\template2.xlsx',function($excel) use($sellings,$yyear){

            $excel->sheet('Report',function($sheet) use($sellings,$yyear){
                $sheet->setOrientation('landscape');
                $sheet->setCellValue('B1',$yyear);
                $count = 3;
                $total = 0.0;

                foreach($sellings as $sell){
                    $sheet->setCellValue('A'.$count,$sell->user);
                    $sheet->setCellValue('B'.$count,$sell->product);
                    $sheet->setCellValue('C'.$count,$sell->brand);
                    $sheet->setCellValue('D'.$count,$sell->category);
                    $sheet->setCellValue('E'.$count,$sell->quantity_sold);
                    $sheet->setCellValue('F'.$count,$sell->price_sold);
                    $sheet->setCellValue('G'.$count,$sell->created_at);

                    //set borders
                    $sheet->setBorder('A'.$count, 'thin');
                    $sheet->setBorder('B'.$count, 'thin');
                    $sheet->setBorder('C'.$count, 'thin');
                    $sheet->setBorder('D'.$count, 'thin');
                    $sheet->setBorder('E'.$count, 'thin');
                    $sheet->setBorder('F'.$count, 'thin');
                    $sheet->setBorder('G'.$count, 'thin');

                    $total += $sell->price_sold*$sell->quantity_sold;
                    $count++;
                }


                $sheet->cell('G'.($count+1),function($cell) use($total){
                    $cell->setFontSize(12);
                    $cell->setFontWeight('bold');
                    $cell->setValue('Total:'.$total);
                });
            });
        })->setFileName($file_name)->store('pdf',storage_path().'\\reports\\pdf');



        return Response::json(['file'=>($file_name.'.pdf')],200);
    }




}
