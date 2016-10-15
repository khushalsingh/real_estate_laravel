<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenanciesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('tenancies', function (Blueprint $table) {
            $table->increments('tenancy_id');
            $table->integer('properties_id');
            $table->dateTime('tenancy_start_date');
            $table->dateTime('tenancy_end_date');
            $table->string('tenancy_rent');
            $table->tinyInteger('tenancy_status')->comment = '-1=deleted;0=inactive,1=active';
            $table->dateTime('tenancy_created');
            $table->dateTime('tenancy_modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('tenancies');
    }

}
