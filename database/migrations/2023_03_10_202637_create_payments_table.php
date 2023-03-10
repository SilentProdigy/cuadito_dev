<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id()->from(10000);
            $table->foreignId('payment_type_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('client_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('amount', 9, 2)->nullable();
            $table->decimal('additional_vat', 9, 2)->nullable();
            $table->decimal('total_amount', 9, 2)->nullable();
            $table->text('details')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->string('status')->default('UNPAID');
            $table->string('or_number')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('payment_method')->nullable();
            // $table->string('period')->nullable()->default('1 month')->comment('Defines the count of months paid');
            $table->timestamps();

            $table->index(['reference_no', 'payment_method']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
