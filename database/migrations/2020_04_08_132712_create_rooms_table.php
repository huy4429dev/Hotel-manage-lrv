<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phong', function (Blueprint $table) {
            $table->id();
            $table->string("ma_phong",50);
            $table->string("trang_thai",50);
            $table->unsignedBigInteger("loai_phong_id");
            $table->timestamps();
        });

        Schema::table('phong', function (Blueprint $table) {
            $table->foreign('loai_phong_id')->references('id')->on('loai_phong');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phong');
    }
}
