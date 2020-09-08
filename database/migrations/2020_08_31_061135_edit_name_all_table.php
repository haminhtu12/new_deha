<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditNameAllTable extends Migration
{
    public function up()
    {
        Schema::rename('category', 'categories');
        Schema::rename('discount', 'discounts');
        Schema::rename('order', 'orders');
        Schema::rename('product', 'products');
    }
    public function down()
    {
        Schema::rename('categories', 'category');
        Schema::rename('discounts', 'discount');
        Schema::rename('orders', 'order');
        Schema::rename('products', 'product');
    }
}
