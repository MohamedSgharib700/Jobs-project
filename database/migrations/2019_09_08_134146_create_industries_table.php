<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->nestedSet();
            $table->string('image')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('industries_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('industry_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();
            $table->timestamps();
            $table->unique(['industry_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('industries');
        Schema::dropIfExists('industries_translations');
    }
}
