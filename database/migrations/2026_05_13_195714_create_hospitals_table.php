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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('location');
            $table->integer('general_beds_total')->default(0);
            $table->integer('general_beds_available')->default(0);
            $table->integer('icu_beds_total')->default(0);
            $table->integer('icu_beds_available')->default(0);
            $table->integer('emergency_beds_total')->default(0);
            $table->integer('emergency_beds_available')->default(0);
            $table->float('distance')->default(0.0);
            $table->string('status')->default('Accepting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
