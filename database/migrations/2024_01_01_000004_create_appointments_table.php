<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->string('customer_name');
            $table->string('email');
            $table->string('phone');
            $table->string('vehicle_year', 4)->nullable();
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_trim')->nullable();
            $table->string('vehicle_mileage')->nullable();
            $table->date('preferred_date')->nullable();
            $table->string('preferred_time')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'])
                ->default('pending');
            $table->string('source')->default('website')->comment('website, zoho, phone, walk-in');
            $table->string('confirmation_number')->nullable()->unique();
            $table->text('internal_notes')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('preferred_date');
            $table->index('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
