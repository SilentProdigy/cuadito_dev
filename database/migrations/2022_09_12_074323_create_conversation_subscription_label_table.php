<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationSubscriptionLabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversation_sub_label', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('conversation_subscription_id')->constrained('conversation_subscriptions')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('label_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('conversation_sub_label');
    }
}
