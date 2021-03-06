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
            'price_sold'=>'500',
            'quantity'=>'1',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'iPhone 6S',
            'brand_id'=>'1',
            'category_id'=>'1',
            'price'=>'550',
            'price_sold'=>'600',
            'quantity'=>'1',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'Pixel',
            'brand_id'=>'3',
            'category_id'=>'1',
            'price'=>'420',
            'price_sold'=>'480',
            'quantity'=>'1',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'iPad Air 2',
            'brand_id'=>'1',
            'category_id'=>'2',
            'price'=>'420',
            'price_sold'=>'500',
            'quantity'=>'1',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'Iphone 5s',
            'brand_id'=>'1',
            'category_id'=>'1',
            'price'=>'250',
            'price_sold'=>'300',
            'quantity'=>'1',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'Galaxy s5',
            'brand_id'=>'2',
            'category_id'=>'1',
            'price'=>'200',
            'price_sold'=>'250',
            'quantity'=>'1',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'Ndegjuese Samsung',
            'brand_id'=>'2',
            'category_id'=>'3',
            'price'=>'15',
            'price_sold'=>'20',
            'quantity'=>'2',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'Ndegjuese Apple',
            'brand_id'=>'1',
            'category_id'=>'3',
            'price'=>'20',
            'price_sold'=>'30',
            'quantity'=>'3',
            'system_deleted'=>'0',
        ]);
        DB::table('products')->insert([
            'name' =>'Ndegjuese Beats By Dre',
            'brand_id'=>'1',
            'category_id'=>'3',
            'price'=>'20',
            'price_sold'=>'30',
            'quantity'=>'4',
            'system_deleted'=>'0',
        ]);
    }
}
