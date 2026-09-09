<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cashier_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cashier_id')->constrained('cashiers')->restrictOnDelete();
            $table->foreignId('opened_by')->constrained('users')->restrictOnDelete();
            $table->dateTime('opened_at');
            $table->decimal('initial_cash', 15, 2)->default(0);
            $table->string('status')->default('open');
            $table->dateTime('closed_at')->nullable();
            $table->foreignId('closed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('expected_cash', 15, 2)->nullable();
            $table->decimal('actual_cash', 15, 2)->nullable();
            $table->decimal('cash_variance', 15, 2)->nullable();
            $table->json('payment_totals')->nullable();
            $table->text('closing_notes')->nullable();
            $table->timestamps();
            $table->index(['cashier_id', 'status']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('cashier_shift_id')->nullable()->after('invoice_id')
                ->constrained('cashier_shifts')->restrictOnDelete();
        });
        Schema::table('cashier_transactions', function (Blueprint $table) {
            $table->foreignId('cashier_shift_id')->nullable()->after('cashier_id')
                ->constrained('cashier_shifts')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('cashier_transactions', fn (Blueprint $table) => $table->dropConstrainedForeignId('cashier_shift_id'));
        Schema::table('payments', fn (Blueprint $table) => $table->dropConstrainedForeignId('cashier_shift_id'));
        Schema::dropIfExists('cashier_shifts');
    }
};
