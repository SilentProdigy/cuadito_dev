<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->char('name', 255);
            $table->boolean('is_featured');
            $table->decimal('price');
            $table->char('unit', 255);
            $table->integer('quantity')->default(0);
            $table->integer('cat_id')->default(0);
            $table->text('description');
            $table->char('part', 255);
            $table->char('model', 255);
            $table->text('picture');
            $table->timestamps();
            $table->index(['name']);
        });
        
        DB::statement('ALTER TABLE products ADD FULLTEXT `search` (`name`)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
