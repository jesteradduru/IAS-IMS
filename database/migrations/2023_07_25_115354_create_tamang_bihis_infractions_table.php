<?php

use App\Models\TamangBihis;
use App\Models\TamangBihisViolation;
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
        Schema::create('tamang_bihis_infractions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignIdFor(TamangBihis::class)->constrained('tamang_bihis');
            $table->foreignIdFor(TamangBihisViolation::class)->constrained('tamang_bihis_violations');
            $table->longText('other_infraction')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamang_bihis_infractions');
    }
};
