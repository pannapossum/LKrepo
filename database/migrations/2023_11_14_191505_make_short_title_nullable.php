<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeShortTitleNullable extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        //
        Schema::table('character_titles', function (Blueprint $table) {
            $table->string('short_title')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        //
        Schema::table('character_titles', function (Blueprint $table) {
            $table->string('short_title')->change();
        });
    }
}
