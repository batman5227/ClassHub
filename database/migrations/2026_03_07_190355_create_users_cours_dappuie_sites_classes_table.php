<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_cours_dappuie_sites_classes', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('idUsers');
            $table->uuid('idCoursDappuie');
            $table->uuid('idSites')->nullable();
            $table->uuid('idClasse')->nullable();
            $table->foreign('idUsers')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('idCoursDappuie')
                  ->references('id')
                  ->on('coursdappuies')
                  ->onDelete('cascade');
            $table->foreign('idSites')
                  ->references('id')
                  ->on('sites')
                  ->onDelete('cascade');
            $table->foreign('idClasse')
                  ->references('id')
                  ->on('classes')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_cours_dappuie_sites_classes');
    }
};
