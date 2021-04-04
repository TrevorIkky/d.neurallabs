<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestStageMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_stage_mapping', function (Blueprint $table) {
            $table->bigIncrements('request_stage_mapping_id');
            $table->unsignedBigInteger('request_id');
            $table->unsignedBigInteger('stage_id');
            $table->foreign('request_id')->references('request_id')->on('requests');
            $table->foreign('stage_id')->references('stage_id')->on('stages');
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
        Schema::dropIfExists('request_stage_mapping');
    }
}
