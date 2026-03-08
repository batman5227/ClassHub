<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');

        Schema::create('eleves', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('telephoneParent');
            $table->uuid('idClasse');
            $table->uuid('idSites');
            $table->uuid('idCoursDappuie');

            $table->foreign('idClasse')
                  ->references('id')
                  ->on('classes')
                  ->onDelete('cascade');

            $table->foreign('idSites')
                  ->references('id')
                  ->on('sites')
                  ->onDelete('cascade');

            $table->foreign('idCoursDappuie')
                  ->references('id')
                  ->on('coursdappuies')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleves');
    }
};
