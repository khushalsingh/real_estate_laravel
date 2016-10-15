<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('groups_id');
            $table->string('user_login');
            $table->string('password');
            $table->string('user_security_hash');
            $table->string('user_name');
            $table->string('email')->unique();
            $table->string('user_address');
            $table->string('user_contact');
            $table->string('user_logged_in')->nullable();
            $table->tinyInteger('user_status')->comment = '-1=deleted;0=inactive,1=active';
            $table->string('force_change_password')->default('0');
            $table->dateTime('user_created');
            $table->dateTime('user_modified')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'groups_id' => '1',
            'user_login' => 'ksingh.cec@gmail.com',
            'password' => '$2y$10$fDk8sj.vCerXihCtOLGXLuVK7bpFBWC.NE03swnf8F8z9NH7jxJWC',
            'user_security_hash' => 'b725642bc847f59b3d360d1fa491e673',
            'user_name' => 'Khushal',
            'email' => 'ksingh.cec@gmail.com',
            'user_address' => 'mohali',
            'user_contact' => '123456789',
            'user_logged_in' => NULL,
            'user_status' => '1',
            'force_change_password' => '0',
            'user_created' => date('Y-m-d H:i:s')
                ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
