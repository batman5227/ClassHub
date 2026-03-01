<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Vérifier si la colonne existe déjà (pour éviter l'erreur lors de migrate:fresh)
        if (!Schema::hasColumn('documents', 'fichier')) {
            Schema::table('documents', function (Blueprint $table) {
                $table->string('fichier')->nullable()->after('idMatiere');
            });
        }
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('fichier');
        });
    }
};
