<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('code', 20);
            $table->text('description')->nullable();
            $table->string('method');
            $table->json('module_type')->nullable();
            $table->json('discount Information')->nullable();
            $table->json(' applySource')->nullable();
            $table->integer('neverEndDate')->nullable();
            $table->timestamp('startDate');
            $table->timestamp('endDate');
            $table->tinyInteger('publish')->default(1);
            $table->integer('order')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};