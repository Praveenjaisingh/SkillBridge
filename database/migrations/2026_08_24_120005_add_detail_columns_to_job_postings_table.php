<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->json('responsibilities')->nullable()->after('requirements');
            $table->json('nice_to_have')->nullable()->after('responsibilities');
            $table->json('benefits')->nullable()->after('nice_to_have');
        });
    }

    public function down(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropColumn(['responsibilities', 'nice_to_have', 'benefits']);
        });
    }
};
