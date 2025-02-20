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
        Schema::create('recurring_transfers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('source_id')->constrained('wallets');
            $table->foreignId('target_id')->constrained('wallets');
            $table->integer('amount')->unsigned();
            $table->string('reason');
            $table->integer('frequency_days');
            $table->date('start_date');
            $table->date('end_date');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_transfers');
    }
};
