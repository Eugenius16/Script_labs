<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tracker', function (Blueprint $table) {
            $table->string('method', 10)->default('GET')->after('ip');
            $table->json('context')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('tracker', function (Blueprint $table) {
            $table->dropColumn(['method', 'context']);
        });
    }
};