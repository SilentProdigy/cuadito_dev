<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_type_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('client_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('expiration_date')->nullable();
            $table->string('status')->default('ACTIVE');
            $table->unsignedBigInteger('points')->default(0);
            $table->timestamps();

            $table->index(['subscription_type_id', 'client_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
