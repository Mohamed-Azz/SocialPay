<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('babs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., سلف، هبات
            $table->enum('type', ['grant', 'loan_full', 'loan_partial']); // هبة، سلفة ترد كاملة، سلفة ترد جزئيا
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('babs');
    }
};
