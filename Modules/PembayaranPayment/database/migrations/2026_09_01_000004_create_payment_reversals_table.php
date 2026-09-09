<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_reversals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->unique()->constrained('payments')->restrictOnDelete();
            $table->foreignId('cashier_shift_id')->constrained('cashier_shifts')->restrictOnDelete();
            $table->text('reason');
            $table->foreignId('reversed_by')->constrained('users')->restrictOnDelete();
            $table->dateTime('reversed_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_reversals');
    }
};
