<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('tenants', function (Blueprint $table) {
            $table->increments('tenant_id');
            $table->integer('properties_id');
            $table->string('tenant_name');
            $table->string('tenant_address');
            $table->tinyInteger('tenant_status')->comment = '-1=deleted;0=inactive,1=active';
            $table->dateTime('tenant_created');
            $table->dateTime('tenant_modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('tenants');
    }

}
