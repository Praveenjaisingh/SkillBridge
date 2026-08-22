<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coding_problems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('programming_language_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('difficulty')->default('easy');
            $table->text('sample_input')->nullable();
            $table->text('sample_output')->nullable();
            $table->text('constraints')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coding_problems');
    }
};
