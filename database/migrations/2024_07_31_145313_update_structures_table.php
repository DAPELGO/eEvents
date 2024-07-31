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
        Schema::table('structures', function (Blueprint $table) {
            $table->foreign('id_type_structure')->on('valeurs')->references('id')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('id_niveau_structure')->on('valeurs')->references('id')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->integer('parent_id')->nullable()->default(NULL)->change();
            $table->foreign('parent_id')->on('structures')->references('id')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->integer('id_user_created')->nullable()->default(NULL)->change();
            $table->integer('id_user_modified')->nullable()->default(NULL)->change();
            $table->integer('id_user_delete')->nullable()->default(NULL)->change();
            $table->dropColumn('id_localite');
            $table->dropColumn('is_public_structure');
            $table->boolean('is_public_structure')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('structures', function (Blueprint $table) {
            $table->dropForeign(['id_type_structure']);
            $table->dropForeign(['id_niveau_structure']);
            $table->integer('parent_id')->nullable()->default(0)->change();
            $table->dropForeign(['parent_id']);
            $table->integer('id_user_created')->nullable()->default(0)->change();
            $table->integer('id_user_modified')->nullable()->default(0)->change();
            $table->integer('id_user_delete')->nullable()->default(0)->change();
            $table->integer('id_localite')->nullable();
            $table->foreign('id_localite')->on('localites')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->dropColumn('is_public_structure');
            $table->integer('is_public_structure')->nullable();
        });
    }
};
