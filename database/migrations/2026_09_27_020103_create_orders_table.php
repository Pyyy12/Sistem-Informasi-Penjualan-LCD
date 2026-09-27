<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->enum('service_type', ['lcd_only', 'with_installation']); // Pilihan 2 menu
            $table->integer('quantity')->default(1);
            $table->decimal('product_price', 12, 2);
            $table->decimal('service_fee', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2);
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'paid', 'in_process', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};