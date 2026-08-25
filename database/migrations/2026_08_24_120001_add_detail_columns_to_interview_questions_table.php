<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('interview_questions', function (Blueprint $table) {
            $table->longText('detailed_explanation')->nullable()->after('answer');
            $table->text('code_example')->nullable()->after('detailed_explanation');
            $table->json('follow_up_questions')->nullable()->after('code_example');
            $table->json('related_topics')->nullable()->after('follow_up_questions');
        });
    }

    public function down(): void
    {
        Schema::table('interview_questions', function (Blueprint $table) {
            $table->dropColumn(['detailed_explanation', 'code_example', 'follow_up_questions', 'related_topics']);
        });
    }
};
