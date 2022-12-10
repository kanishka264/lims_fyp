<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->default(0);
            $table->integer('patient_id')->default(0);
            $table->integer('test_id')->default(0);
            $table->double('fee')->default(0);
            $table->timestamp('appointment_time')->nullable();
            $table->string('payment_referance')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('recived_status')->default(0);
            $table->string('verified_status')->default(0);
            $table->longText('barcode')->nullable();
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
        Schema::dropIfExists('test_orders');
    }
}
