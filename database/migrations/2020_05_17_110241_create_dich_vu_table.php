<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDichVuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dich_vu', function (Blueprint $table) {

            $table->id();
            $table->integer("so_luong");
            $table->unsignedBigInteger("mat_hang_id");
            $table->unsignedBigInteger("phong_id");
            $table->timestamps();
        });

        Schema::table('dich_vu', function (Blueprint $table) {

            $table->foreign('mat_hang_id')->references('id')->on('cua_hang');
            $table->foreign('phong_id')->references('id')->on('phong');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dich_vu', function (Blueprint $table) {
            //
        });
    }
}
