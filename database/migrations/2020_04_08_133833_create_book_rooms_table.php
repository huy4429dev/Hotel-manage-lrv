<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dat_phong', function (Blueprint $table) {
            $table->id();
            $table->dateTime("thoi_gian_dat");
            $table->string("ghi_chu",255)->nullable();
            $table->unsignedBigInteger("phong_id");
            $table->unsignedBigInteger("khach_hang_id");
            $table->timestamps();
        });

        Schema::table('dat_phong', function (Blueprint $table) {
            $table->foreign('phong_id')->references('id')->on('phong');
            $table->foreign('khach_hang_id')->references('id')->on('khach_hang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dat_phong');
    }
}
