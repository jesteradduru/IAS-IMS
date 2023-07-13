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
        Schema::create('pro_actives', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignIdFor(InspectingOffice::class, 'inspecting_office_id')->constrained('inspecting_offices');
            $table->foreignIdFor(User::class, 'by_user_id');
            $table->dateTime('date_time');
            $table->foreignIdFor(Unit::class, 'unit_id')->constrained('units');
            $table->longText('street');
            $table->longText('barangay');
            $table->longText('municipality');
            $table->longText('province');
            $table->longText('region');
            $table->unsignedBigInteger('ap');
            $table->unsignedBigInteger('aa');
            $table->unsignedBigInteger('ua');
            $table->text('type');
            $table->text('special_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pro_actives');
    }
};
