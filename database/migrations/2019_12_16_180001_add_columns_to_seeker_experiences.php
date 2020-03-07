<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToSeekerExperiences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seeker_experiences', function (Blueprint $table) {
            $table->string('educational_degree')->after('user_id')->nullable();
            $table->string('educational_degree_year')->after('educational_degree')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seeker_experiences', function (Blueprint $table) {
            $table->dropColumn('educational_degree');
            $table->dropColumn('educational_degree_year');
        });
    }
}
