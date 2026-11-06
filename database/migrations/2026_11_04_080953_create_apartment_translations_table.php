<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('apartment_translations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('apartment_id')->constrained('apartments')->cascadeOnDelete();
        $table->string('locale', 10); 
        $table->string('title');
        $table->text('description')->nullable();
        $table->timestamps();

        $table->unique(['apartment_id', 'locale']); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartment_translations');
    }
};
