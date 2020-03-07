<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->integer('industry_id');
            $table->string('company_size')->nullable();
            $table->string('job_title')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('user_id');
            $table->boolean('active')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('employer_details');
    }
}
