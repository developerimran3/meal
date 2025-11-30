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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();


            $table->decimal('seat_rent', 10, 2)->default(0);
            $table->decimal('wifi', 10, 2)->default(0);
            $table->decimal('khala', 10, 2)->default(0);
            $table->decimal('utility_bill', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);

            $table->string('month');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
