<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_hoa_don', function (Blueprint $table) {
            $table->id();
            $table->integer("so_luong");
            $table->float("don_gia");
            $table->float("thanh_tien");
            $table->unsignedBigInteger("mat_hang_id");
            $table->unsignedBigInteger("hoa_don_id");
            $table->timestamps();
        });
        Schema::table('chi_tiet_hoa_don', function (Blueprint $table) {
            $table->foreign('mat_hang_id')->references('id')->on('cua_hang');
            $table->foreign('hoa_don_id')->references('id')->on('hoa_don');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chi_tiet_hoa_don');
    }
}
