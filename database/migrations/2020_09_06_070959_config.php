<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Config extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('logo')->nullAble();
            $table->string('favicon')->nullAble();
            $table->integer('active')->default(1);
            $table->string('facebook')->nullAble();
            $table->string('youtube')->nullAble();
            $table->string('instagram')->nullAble();
            $table->string('linkedin')->nullAble();
            $table->string('github')->nullAble();
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
        Schema::dropIfExists('configs');
    }
}
