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
        Schema::create('cat_people', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->foreign('cat_id')->on('cats')->references('id');
            $table->integer('people_id');
            $table->foreign('people_id')->on('people')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_peoples');
    }
};
