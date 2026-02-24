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
        Schema::table('projects', function (Blueprint $table) {
            // Add JSON column for content blocks
            $table->json('content_blocks')->nullable()->after('content');
        });

        // Rename content to content_legacy
        if (Schema::hasColumn('projects', 'content')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->renameColumn('content', 'content_legacy');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('projects', 'content_legacy')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->renameColumn('content_legacy', 'content');
            });
        }

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('content_blocks');
        });
    }
};
