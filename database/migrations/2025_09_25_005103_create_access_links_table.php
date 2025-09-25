<?php

declare(strict_types=1);

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
        Schema::create('access_links', function (Blueprint $table) {
            $table->id();
            $table->uuid('link_id')->index()->unique();
            $table->boolean('is_active')->default(false);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamp('expires_at');
            $table->timestamps();

            $table->index(['expires_at', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_links');
    }
};
