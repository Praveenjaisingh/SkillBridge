<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('coding_problems', function (Blueprint $table) {
            $table->longText('approach')->nullable()->after('description');
            $table->json('examples')->nullable()->after('approach');
            $table->json('hints')->nullable()->after('examples');
            $table->string('time_complexity')->nullable()->after('hints');
            $table->string('space_complexity')->nullable()->after('time_complexity');
        });
    }

    public function down(): void
    {
        Schema::table('coding_problems', function (Blueprint $table) {
            $table->dropColumn(['approach', 'examples', 'hints', 'time_complexity', 'space_complexity']);
        });
    }
};
