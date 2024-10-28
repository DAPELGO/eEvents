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
        Schema::dropIfExists('localites');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('localites', function (Blueprint $table) {
            $table->id();
            $table->integer('id_parent');
            $table->string('libelle')->nullable();
            $table->boolean('is_delete')->nullable()->default(false);
            $table->integer('id_user_created')->nullable()->default(NULL);
            $table->integer('id_user_modified')->nullable()->default(NULL);
            $table->integer('id_user_delete')->nullable()->default(NULL);
            $table->foreign('id_user_created')->on('admins')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_user_modified')->on('admins')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_user_delete')->on('admins')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }
};
