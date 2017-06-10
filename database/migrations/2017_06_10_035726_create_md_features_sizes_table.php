<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMdFeaturesSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('md_features_sizes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 255);
            $table->integer('state')->default(0);
            $table->integer('id_md_features_sizes_category')->unsigned()->index();
            $table->timestamps();
            $table->foreign('id_md_features_sizes_category')->references('id')->on('md_features_sizes_category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('md_features_sizes');
    }
}
