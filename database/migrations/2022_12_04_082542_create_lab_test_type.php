<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabTestType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_test_type', function (Blueprint $table) {
            $table->id();
            $table->string('test_title')->nullable();
            $table->string('test_code')->nullable()->unique();
            $table->string('test_field')->nullable();
            $table->string('report_template')->nullable();
            $table->integer('active')->default(1);
            $table->double('amount')->default(0);
            $table->string('image_name')->nullable();
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
        Schema::dropIfExists('lab_test_type');
    }
}
