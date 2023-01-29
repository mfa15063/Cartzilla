<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->string('name');
            $table->decimal('standard',18);
            $table->decimal('premium',18)->nullable();
            $table->decimal('gold',18)->nullable();
            $table->string('product_image')->nullable();
            $table->string('weight')->nullable();
            $table->string('size')->nullable();
            $table->string('measuring_unit')->nullable();
            $table->text('color')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('is_featured')->default(0);
            $table->boolean('in_stock')->default(1);
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->index('name');
            // $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('SET NULL');
            // $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('SET NULL');
            // $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('SET NULL');
            // $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
