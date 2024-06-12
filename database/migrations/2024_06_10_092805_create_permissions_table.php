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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('nom_permission')->nullable();
            $table->string('group_name')->nullable();
            $table->string('group_slug')->nullable();
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
        Schema::dropIfExists('permissions');
    }
};
