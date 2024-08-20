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
        Schema::table('articles', function (Blueprint $table) {
            $table->text('titre')->change();
            $table->text('slug')->change();
            $table->dropColumn('description');
            $table->longText('content')->nullable();
            $table->boolean('is_published')->default(false);
            $table->integer('id_user_created')->nullable()->default(NULL)->change();
            $table->integer('id_user_modified')->nullable()->default(NULL)->change();
            $table->integer('id_user_delete')->nullable()->default(NULL)->change();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('titre')->change();
            $table->string('slug')->change();
            $table->text('description')->nullable();
            $table->dropColumn('content');
            $table->dropColumn('is_published');
            $table->integer('id_user_created')->nullable()->default(0)->change();
            $table->integer('id_user_modified')->nullable()->default(0)->change();
            $table->integer('id_user_delete')->nullable()->default(0)->change();
            $table->dropSoftDeletes();
        });
    }
};
