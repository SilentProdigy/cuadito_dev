<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('ACTIVE');
            // $table->string('cost_and_payment')->nullable();
            $table->decimal('cost', 9, 2);
            $table->string('scope_of_work')->nullable();
            $table->text('terms_and_conditions')->nullable();
            $table->text('relevant_authorities')->nullable();
            $table->foreignId('company_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->text('remarks')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            $table->index(['title', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
