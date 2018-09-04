<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTypeNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_type_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_type_id')->unsigned();
            $table->integer('notification_event_id')->unsigned();
            $table->integer('notification_type_id')->unsigned();
            $table->string('destiny', 100);
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
        Schema::dropIfExists('service_type_notifications');
    }
}
