<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiddingRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidding_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidding_id')->constrained('biddings')->onDelete('cascade')->onUpdate('cascade');

            $table->foreignId('project_requirement_id')->constrained('project_requirements')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->string('url');
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
        Schema::dropIfExists('bidding_requirements');
    }
}
