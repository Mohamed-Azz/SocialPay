<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bab_id')->constrained()->onDelete('cascade');
            $table->string('name'); // e.g., منحة زواج، سلفة سيارة
            $table->decimal('amount', 15, 2);
            $table->text('conditions')->nullable(); // شروط الاستفادة
            $table->text('required_documents')->nullable(); // الوثائق المطلوبة
            $table->decimal('repayment_percentage', 5, 2)->default(0); // نسبة الاسترداد
            $table->integer('installments_count')->default(0); // عدد أشهر الاقتطاع
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grants');
    }
};
