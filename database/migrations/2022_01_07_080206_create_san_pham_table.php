<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanPhamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('san_pham', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_danh_muc')->unsigned();
            $table->string('ten');
            $table->text('mota');
            $table->string('gia');
            $table->integer('soluongban');
            $table->string('ngaydang');
            $table->text('anh')->nullable();
            $table->foreign('id_danh_muc')->references('id')->on('danh_muc')->onDelete('cascade');
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
        Schema::dropIfExists('san_pham');
    }
}