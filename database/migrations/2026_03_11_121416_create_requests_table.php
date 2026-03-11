<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->foreignId('grant_id')->constrained()->onDelete('cascade');
            $table->foreignId('mandate_id')->constrained()->onDelete('cascade');
            $table->string('file_path')->nullable(); // PDF file
            $table->enum('status', ['pending', 'beneficiary', 'rejected_temp', 'rejected_final'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
