<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
  
   public function up()
    {
                Schema::create('locations', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->string('code')->nullable();
                    $table->boolean('active')->default(1);;
                    $table->string('image')->nullable();
                    $table->nestedSet();
                    $table->timestamps();
                    $table->softDeletes();
                });
        
                Schema::create('locations_translations', function(Blueprint $table)
                {
                    $table->increments('id');
                    $table->integer('location_id')->unsigned();
                    $table->string('name');
                    $table->string('locale')->index();
                    $table->timestamps();
                    $table->unique(['location_id','locale']);
                });
            }

    public function down()
    {
        Schema::dropIfExists('locations');
        Schema::dropIfExists('locations_translations');
    }
}
