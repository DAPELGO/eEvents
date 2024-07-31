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
        Schema::table('parametres', function (Blueprint $table) {
            $table->integer('id_user_created')->nullable()->default(NULL)->change();
            $table->integer('id_user_modified')->nullable()->default(NULL)->change();
            $table->integer('id_user_delete')->nullable()->default(NULL)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parametres', function (Blueprint $table) {
            $table->integer('id_user_created')->nullable()->default(0)->change();
            $table->integer('id_user_modified')->nullable()->default(0)->change();
            $table->integer('id_user_delete')->nullable()->default(0)->change();
        });
    }
};
