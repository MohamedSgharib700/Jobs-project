<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColummnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('name')->nullable();
            $table->string('last_name')->after('first_name')->nullable();
            $table->string('country_key')->after('last_name')->nullable();
            $table->unsignedBigInteger('nationality_id')->after('country_key')->nullable();
            $table->string('phone')->after('nationality_id');
            $table->string('job_title')->after('phone')->nullable();
            $table->string('image')->after('job_title')->nullable();
            $table->boolean('gender')->after('image')->nullable();
            $table->tinyInteger('type')->after('gender');
            $table->string('age')->after('type')->nullable();
            $table->boolean('active')->after('age')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::dropIfExists("users");
        });
    }
}
