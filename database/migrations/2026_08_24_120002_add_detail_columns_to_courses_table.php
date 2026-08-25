<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->json('learning_outcomes')->nullable()->after('description');
            $table->text('prerequisites')->nullable()->after('learning_outcomes');
            $table->string('target_audience')->nullable()->after('prerequisites');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['learning_outcomes', 'prerequisites', 'target_audience']);
        });
    }
};
