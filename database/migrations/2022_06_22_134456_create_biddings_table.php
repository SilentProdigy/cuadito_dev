<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biddings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('project_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            // $table->string('quotation_url');
            $table->text('cover_letter');
            $table->decimal('rate', 12, 2);
            $table->boolean('is_paid')->default(false);
            // $table->string('payment_reference_no')->nullable();
            // $table->string('payment_date')->nullable();
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
        Schema::dropIfExists('biddings');
    }
}
