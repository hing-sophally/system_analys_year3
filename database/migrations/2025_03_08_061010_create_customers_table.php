<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();  // Automatically creates an auto-incrementing ID
            $table->string('name');  // Name field
            $table->string('phone')->unique();  // Phone number (unique to prevent duplicates)
            $table->enum('gender', ['male', 'female', 'other']);  // Gender field (with options)
            $table->string('alt_phone')->nullable();  // Alternative phone, nullable
            $table->integer(column: 'point')->default(0);  // Points, default to 0
            $table->string('email')->unique();  // Email (unique)
            $table->string('current_location');  // Current location field
            $table->timestamps();  // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
