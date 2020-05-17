<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoa_don', function (Blueprint $table) {
            $table->id();
            $table->boolean("trang_thai");
            $table->float("tong_tien");
            $table->unsignedBigInteger("phong_id");
            $table->unsignedBigInteger("khach_hang_id");
            $table->unsignedBigInteger("user_id");
            $table->timestamps();
        });

        Schema::table('hoa_don', function (Blueprint $table) {
            $table->foreign('phong_id')->references('id')->on('phong');
            $table->foreign('khach_hang_id')->references('id')->on('khach_hang');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoa_don');
    }
}
