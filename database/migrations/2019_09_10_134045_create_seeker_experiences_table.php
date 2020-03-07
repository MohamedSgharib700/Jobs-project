<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeekerExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seeker_experiences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('years_of_experience')->nullable();
            $table->tinyInteger('education_level')->nullable();
            $table->text('previous_experience')->nullable();
            $table->date('previous_experience_from_date')->nullable();
            $table->date('previous_experience_to_date')->nullable();
            $table->tinyInteger('career_level')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seeker_experiences');
    }
}
