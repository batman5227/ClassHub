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
        Schema::table('eleves', function (Blueprint $table) {
            // Ajouter numParents
            $table->string('numParents')->nullable()->after('prenom');

            // Supprimer les colonnes non nécessaires
            $table->dropForeign(['idClasse']);
            $table->dropForeign(['idSites']);
            $table->dropForeign(['idCoursDappuie']);
            $table->dropColumn(['email', 'idClasse', 'idSites', 'idCoursDappuie']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eleves', function (Blueprint $table) {
            // Restaurer les colonnes
            $table->string('email')->unique()->after('prenom');
            $table->uuid('idClasse')->nullable();
            $table->uuid('idSites')->nullable();
            $table->uuid('idCoursDappuie')->nullable();

            // Ajouter les foreign keys
            $table->foreign('idClasse')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('idSites')->references('id')->on('sites')->onDelete('cascade');
            $table->foreign('idCoursDappuie')->references('id')->on('coursdappuies')->onDelete('cascade');

            // Supprimer numParents
            $table->dropColumn(['numParents']);
        });
    }
};

