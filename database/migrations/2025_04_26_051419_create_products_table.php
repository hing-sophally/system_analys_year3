<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('category_id');
        $table->string('name');
        $table->string('image_url')->nullable();
        $table->text('description');
        $table->decimal('price', 10, 2);
        $table->integer('stock')->default(0);
        $table->boolean('status')->default(1);
        $table->timestamps();

        // Foreign key relation
        $table->foreign('category_id')
              ->references('id')
              ->on('categories')
              ->onDelete('cascade');
    });
}

};
