<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->index();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('address');
            $table->string('phone');
            $table->date('birthday');
            $table->integer('category_id')->unsigned()->index();
            $table->integer('city_id')->unsigned()->index();
            $table->integer('company_id')->unsigned()->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
