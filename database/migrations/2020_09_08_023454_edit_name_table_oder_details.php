<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditNameTableOderDetails extends Migration
{
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->renameColumn('productDetails_id', 'product_details_id');
        });
    }
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->renameColumn('product_details_id', 'productDetails_id');
        });

    }
}
