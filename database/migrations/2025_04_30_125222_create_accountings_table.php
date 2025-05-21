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
        Schema::create('accountings', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->decimal('value', 10, 2)->nullable();
            $table->date('date')->nullable()->after('value');
            $table->date('competence_month')->nullable()->after('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accountings');
        Schema::table('accountings', function (Blueprint $table) {
            $table->dropColumn(['date', 'competence_month']);
        });
    }
};
