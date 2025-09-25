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
        Schema::create('lucky_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('access_link_id')->constrained('access_links')->cascadeOnDelete();
            $table->unsignedSmallInteger('roll');
            $table->boolean('is_win');
            $table->bigInteger('payout');
            $table->float('percent');
            $table->timestamp('created_at')->index()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lucky_results');
    }
};
