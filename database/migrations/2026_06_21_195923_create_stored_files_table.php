<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stored_files', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('folder_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('original_name');
            $table->string('stored_name');
            $table->string('path');
            $table->unsignedBigInteger('size');
            $table->string('mime_type');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stored_files');
    }
};