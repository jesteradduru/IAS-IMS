<?php

use App\Models\Awol;
use App\Models\AwolStatusProcess;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('awol_status_history', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignIdFor(User::class, 'by_user_id')->constrained('users');
            $table->foreignIdFor(Awol::class, 'awol_id')->constrained('awol');
            $table->foreignIdFor(AwolStatusProcess::class, 'awol_process_id')->constrained('awol_status_processes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awol_status_history');
    }
};
