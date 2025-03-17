<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // Foreign key to customers table
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->decimal('grand_total', 10, 2); // The total amount of the invoice
            $table->foreignId('delivery_id')->nullable()->constrained()->onDelete('set null'); // Foreign key to deliveries table
            $table->dateTime('pick_up_date_time'); // Date and time for pickup
            $table->enum('status', ['on_hold', 'processing', 'completed'])->default('on_hold'); // Status of the invoice
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
