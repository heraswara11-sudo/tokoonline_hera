<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek dulu biar tidak error jika tabel sudah ada
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();

                $table->string('order_number')->unique();
                $table->string('customer_name');
                $table->string('customer_email');
                $table->string('customer_phone');
                $table->text('customer_address')->nullable();

                $table->decimal('total', 15, 2)->default(0);
                $table->string('status')->default('pending');
                $table->text('notes')->nullable();

                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};