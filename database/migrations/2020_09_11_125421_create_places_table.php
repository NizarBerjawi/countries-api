<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id('geoname_id');
            $table->string('name');
            $table->unsignedBigInteger('population')->nullable();
            $table->smallInteger('elevation')->nullable();
            $table->string('feature_code')->nullable();
            $table->string('country_code')->nullable();
            $table->timestamps();
        });

        Schema::table('places', function (Blueprint $table) {
            $table->foreign('feature_code')->references('code')->on('feature_codes')->onCascade('delete');
            $table->foreign('country_code')->references('iso3166_alpha2')->on('countries')->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropForeign(['feature_code']);
            $table->dropForeign(['country_code']);
        });
        Schema::dropIfExists('places');
    }
}
