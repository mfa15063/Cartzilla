<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserDetailsInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('checkout_fname')->nullable();
            $table->string('order_number')->nullable();
            $table->string('checkout_lname')->nullable();
            $table->string('checkout_email')->nullable();
            $table->string('checkout_phone')->nullable();
            $table->string('checkout_city_id')->nullable();
            $table->string('checkout_zip_code')->nullable();
            $table->string('checkout_address')->nullable();
            $table->string('checkout_address_two')->nullable();
            $table->string('payment_method')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
