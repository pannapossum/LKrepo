<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('rarities', function (Blueprint $table) {
            $table->integer('has_icon');
            $table->string('icon_hash');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('rarities', function (Blueprint $table) {
            $table->dropColumn('has_icon');
            $table->dropColumn('icon_hash');
        });
    }
};
