<?php
use Illuminate\Database\Seeder;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' =>'iPhone 6',
            'brand_id'=>'1',
            'category_id'=>'1',
            'price'=>'450',
            'price_decreased' =>'410',
            'quantity'=>'1',
            'imei'=>'123456789876543',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'iPhone 6S',
            'brand_id'=>'1',
            'category_id'=>'1',
            'price'=>'550',
            'price_decreased' =>'510',
            'quantity'=>'1',
            'imei'=>'123456789876543',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'Pixel',
            'brand_id'=>'3',
            'category_id'=>'1',
            'price'=>'420',
            'quantity'=>'1',
            'imei'=>'123456789876543',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'iPad Air 2',
            'brand_id'=>'1',
            'category_id'=>'2',
            'price'=>'420',
            'quantity'=>'1',
            'imei'=>'123456789876543',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'Iphone 5s',
            'brand_id'=>'1',
            'category_id'=>'1',
            'price'=>'250',
            'price_decreased'=>'220',
            'quantity'=>'1',
            'imei'=>'1234567829876543',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'Galaxy s5',
            'brand_id'=>'2',
            'category_id'=>'1',
            'price'=>'200',
            'quantity'=>'1',
            'imei'=>'123456782928716543',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'Ndegjuese Samsung',
            'brand_id'=>'2',
            'category_id'=>'3',
            'price'=>'15',
            'quantity'=>'2',
            'imei'=>'',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'Ndegjuese Apple',
            'brand_id'=>'1',
            'category_id'=>'3',
            'price'=>'20',
            'quantity'=>'3',
            'imei'=>'',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'Ndegjuese Beats By Dre',
            'brand_id'=>'1',
            'category_id'=>'3',
            'price'=>'20',
            'quantity'=>'4',
            'imei'=>'',
            'system_deleted'=>'0',
        ]);
    }
}
