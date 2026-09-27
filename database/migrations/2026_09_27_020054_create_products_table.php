<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: LCD iPhone 13 Pro Max Super Retina OLED
            $table->string('brand'); // Apple, Samsung, Xiaomi, Oppo, dll
            $table->enum('os_type', ['iPhone', 'Android']);
            $table->text('description')->nullable();
            $table->decimal('price_lcd_only', 12, 2); // Harga LCD saja
            $table->decimal('installation_fee', 12, 2)->default(50000); // Biaya jasa pasang
            $table->integer('stock')->default(10);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};