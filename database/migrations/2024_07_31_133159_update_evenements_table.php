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
        Schema::table('evenements', function (Blueprint $table) {
            $table->dropColumn('id_localite');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evenements', function (Blueprint $table) {
            $table->integer('id_localite')->nullable();
            $table->foreign('id_localite')->on('localites')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }
};
