<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('notes')->nullable();
            $table->boolean('active')->default(1);
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('item_id')->constrained();
            $table->boolean('require_out')->default(0);
            $table->foreignId('authorized_by_id')
                ->nullable()
                ->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
