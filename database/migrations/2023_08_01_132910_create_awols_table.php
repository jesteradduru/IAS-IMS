<?php

use App\Models\InspectingOffice;
use App\Models\Unit;
use App\Models\User;
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
        Schema::create('awol', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignIdFor(InspectingOffice::class, 'inspecting_office_id')->constrained('inspecting_offices');
            $table->foreignIdFor(User::class, 'by_user_id')->constrained('users');
            $table->foreignIdFor(Unit::class, 'unit_id')->constrained('units');
            $table->text('fullname');
            $table->date('date');
            $table->date('effectivity_date');
            $table->string('order_number');
            $table->text('remarks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awol');
    }
};
