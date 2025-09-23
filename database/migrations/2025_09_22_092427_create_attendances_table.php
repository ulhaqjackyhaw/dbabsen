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
    Schema::create('attendances', function (Blueprint $table) {
        $table->id();
        $table->string('personal_number')->nullable();
        $table->string('name')->nullable();
        $table->string('attendance_type')->nullable();
        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();
        $table->integer('days')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
