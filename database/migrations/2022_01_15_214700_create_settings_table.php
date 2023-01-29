<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->string('setting_name');
            $table->string('setting_key')->unique();
            $table->string('setting_value')->length('500');
            $table->boolean('is_readonly')->default(1)->index();
            $table->timestamps();

            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
