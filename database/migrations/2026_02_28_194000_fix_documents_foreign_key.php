<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // La colonne idMatiere existe déjà dans la migration originale
        // On ajoute uniquement la clé étrangère
        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('idMatiere')
                  ->references('id')
                  ->on('matieres')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['idMatiere']);
        });
    }
};
