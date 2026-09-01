<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('model');
            $table->string('serial');
            $table->string('notes')->nullable();
            $table->foreignId('section_id')->constrained();
            $table->foreignId('type_id')->constrained();
            $table->foreignId('brand_id')->constrained();
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
