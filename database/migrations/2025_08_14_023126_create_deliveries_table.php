<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('deliveries')) {
            Schema::create('deliveries', function (Blueprint $table) {
                $table->id();

                $table->foreignId('order_id')
                    ->constrained('orders')
                    ->cascadeOnDelete();

                $table->foreignId('deliverer_id')
                    ->constrained('users')
                    ->cascadeOnDelete();

                $table->string('status')->default('assigned'); // assigned|picked_up|en_route|delivered|cancelled
                $table->string('address')->nullable();
                $table->text('notes')->nullable();
                $table->timestamp('delivered_at')->nullable();
                $table->timestamp('cancelled_at')->nullable();

                $table->timestamps();

                $table->index(['deliverer_id', 'status']);
                $table->index('order_id');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
