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
        Schema::create('awol_status_processes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->text('title');
            $table->text('description');
            $table->boolean('final')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awol_status_processes');
    }
};
