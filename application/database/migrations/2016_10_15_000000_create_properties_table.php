<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('properties', function (Blueprint $table) {
            $table->increments('property_id');
            $table->string('property_name');
            $table->string('property_address');
            $table->string('property_value');
            $table->integer('property_mortgage');
            $table->tinyInteger('property_status')->comment = '-1=deleted;0=inactive,1=active';
            $table->dateTime('property_created');
            $table->dateTime('property_modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('properties');
    }

}
