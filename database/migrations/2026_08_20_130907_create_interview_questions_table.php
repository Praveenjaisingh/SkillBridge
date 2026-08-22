<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interview_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('programming_language_id')->nullable()->constrained()->nullOnDelete();
            $table->text('question');
            $table->text('answer')->nullable();
            $table->string('difficulty')->default('easy');
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interview_questions');
    }
};
