<?php

use Illuminate\Database\Seeder;

class ProductTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $product = new \App\Product([
       		'imagePath' => 'https://images-na.ssl-images-amazon.com/images/I/812h7syM-gL._AC_SL1500_.jpg',
       		'title' => 'Life is Strange',
       		'description' =>'Life is strange universe',
       		'price' => 39
       ]);
       $product->save();

       $product = new \App\Product([
       		'imagePath' => 'https://images-na.ssl-images-amazon.com/images/I/51qrbKY5CGL._AC_US218_.jpg',
       		'title' => 'GURHAN Galahad Sterling Silver Medium Oval Link Bracelet',
       		'description' =>'FREE Shipping on eligible orders',
       		'price' => 950
       ]);
       $product->save();

       $product = new \App\Product([
       		'imagePath' => 'https://images-na.ssl-images-amazon.com/images/I/31Msuub1mjL._AC_US218_.jpg',
       		'title' => 'Ray-Ban RB2132 ',
       		'description' =>'New Wayfarer Sunglasses Unisex',
       		'price' => 193 
       ]);
       $product->save();

       $product = new \App\Product([
       		'imagePath' => 'https://images-na.ssl-images-amazon.com/images/I/41MzGM6e1eL._AC_US218_.jpg',
       		'title' => 'Nixon Time Teller A0451919-00',
       		'description' =>'Gold and Green Women’s Watch (37mm. Gold Metal Band/Green Sunray Watch Face)',
       		'price' => 82
       ]);
       $product->save();

       $product = new \App\Product([
       		'imagePath' => 'https://images-na.ssl-images-amazon.com/images/I/51Gocp2MQKL._AC_US218_.jpg',
       		'title' => 'Versace Women',
       		'description' =>' Quartz Gold-Tone and Snake Skin Watch, Color:Blue (Model: VEBM00418)',
       		'price' => 1095
       ]);
       $product->save();

       $product = new \App\Product([
       		'imagePath' => 'https://images-na.ssl-images-amazon.com/images/I/31Se4RSiNEL._AC_US218_.jpg',
       		'title' => 'Kate Spade New York Women',
       		'description' =>'1YRU0812 Holland Analog Display Japanese Quartz Beige Watch',
       		'price' => 99
       ]);
       $product->save();
    }
}
