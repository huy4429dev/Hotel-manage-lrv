<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bai_viet', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de',255);
            $table->string('hinh_anh',255);
            $table->string('mo_ta',255);
            $table->text('noi_dung');
            $table->integer('luot_xem')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::table('bai_viet', function (Blueprint $table) {
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
        Schema::dropIfExists('bai_viet');
    }
}
