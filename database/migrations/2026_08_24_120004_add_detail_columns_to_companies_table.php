<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->unsignedSmallInteger('founded_year')->nullable()->after('industry');
            $table->string('company_size')->nullable()->after('founded_year');
            $table->json('benefits')->nullable()->after('company_size');
            $table->json('tech_stack')->nullable()->after('benefits');
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['founded_year', 'company_size', 'benefits', 'tech_stack']);
        });
    }
};
