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
        Schema::create('structures', function (Blueprint $table) {
            $table->id();
            $table->integer('id_localite')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('code_structure')->nullable();
            $table->string('nom_structure')->nullable();
            $table->integer('level_structure')->nullable();
            $table->integer('id_niveau_structure')->nullable();
            $table->integer('id_type_structure')->nullable();
            $table->integer('is_public_structure')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('is_delete')->nullable()->default(false);
            $table->integer('id_user_created')->nullable()->default(0);
            $table->integer('id_user_modified')->nullable()->default(0);
            $table->integer('id_user_delete')->nullable()->default(0);
            $table->foreign('id_user_created')->on('admins')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_user_modified')->on('admins')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_user_delete')->on('admins')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structures');
    }
};
