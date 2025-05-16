<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fosters', function (Blueprint $table) {
            $table->id();
            //宠物id
            $table->unsignedBigInteger('pet_id');
            $table->foreign('pet_id')->references('id')->on('pets')->onDelete('cascade');
            //寄养开始日期
            $table->dateTime('start_date');
            //寄养结束日期
            $table->dateTime('end_date')->nullable();
            //寄养备注
            $table->text('remark')->nullable();
            //寄养服务状态
            $table->string('status');
            //金额
            $table->float('amount');
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
        Schema::dropIfExists('fosters');
    }
}
