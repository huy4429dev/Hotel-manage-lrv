<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableViTri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vi_tri', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('ten');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('vi_tri_id')->references('id')->on('vi_tri');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vi_tri');
    }
}
