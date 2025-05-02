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
        Schema::table('categories', function (Blueprint $table) {
            // Add the new columns
            $table->string('image_url')->nullable(); // For storing the image URL
            $table->text('description')->nullable(); // For storing a description
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            // Drop the columns in case of rollback
            $table->dropColumn(['image_url', 'description']);
        });
    }
};
