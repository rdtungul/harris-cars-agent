<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zoho_form_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('form_name');
            $table->json('payload');
            $table->string('ip_address')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->string('processing_status')->default('received')->comment('received, processed, failed');
            $table->text('processing_notes')->nullable();
            $table->timestamps();

            $table->index('form_name');
            $table->index('processing_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zoho_form_submissions');
    }
};
