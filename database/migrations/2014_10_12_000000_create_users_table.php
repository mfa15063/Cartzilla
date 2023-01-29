<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('post_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(0);
            $table->string('mobile_number')->nullable();
            $table->text('address')->nullable();
            $table->enum('price_category', ['standard', 'premium','gold'])->default('standard');
            $table->foreignId('city_id')->nullable()->constrained()->onUpdate('cascade')
                ->onDelete('SET NULL');
            $table->foreignId('state_id')->nullable()->constrained() ->onUpdate('cascade')
                ->onDelete('SET NULL');
            $table->boolean('status')->default(1);
            $table->rememberToken();
            $table->timestamps();

            // indexes
            $table->index(['city_id', 'state_id','post_code']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
