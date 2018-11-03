<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->integer('customer_id');
            $table->string('service_type_id');
            $table->integer('service_status_id')->default(1);
            $table->integer('cost')->default(0);
            $table->text('custom');
            $table->date('service_date');
            $table->date('finish_date')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('branch_id')->index();
            $table->integer('company_id')->index();
            $table->integer('resource_id')->index();
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
        Schema::dropIfExists('services');
    }
}
