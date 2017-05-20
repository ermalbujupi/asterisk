<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckLowProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckLowProducts:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check which products are low on stock';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('low_in_stock')->truncate();
        $low_stock = DB::table('products')->where('quantity','<',3)->pluck('id');
        foreach ($low_stock as $product){
            DB::table('low_in_stock')->insert([
                'product_id'=>$product
            ]);
        }

    }
}
