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
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->integer('id_categorie')->nullable();
            $table->integer('id_localite')->nullable();
            $table->integer('id_structure')->nullable();
            $table->string('libelle')->nullable();
            $table->string('url_img')->nullable();
            $table->date('date_event')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_delete')->nullable()->default(false);
            $table->integer('id_user_created')->nullable()->default(0);
            $table->integer('id_user_modified')->nullable()->default(0);
            $table->integer('id_user_delete')->nullable()->default(0);
            $table->foreign('id_categorie')->on('categories')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_localite')->on('localites')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_structure')->on('structures')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('evenements');
    }
};
