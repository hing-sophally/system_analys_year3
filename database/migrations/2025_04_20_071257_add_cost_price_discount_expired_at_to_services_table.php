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
        Schema::table('services', function (Blueprint $table) {
            $table->decimal('cost', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discount', 5, 2)->nullable();
            $table->date('expired_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['cost', 'price', 'discount', 'expired_at']);
        });
    }
    
};
