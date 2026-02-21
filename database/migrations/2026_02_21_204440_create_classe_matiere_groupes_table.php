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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')
                ->primary()
                ->default(DB::raw('uuid_generate_v4()'));
             $table->uuid('idMatiere');
            $table-> foreign("idMatiere")->references("id")->on("classeMatiereGroupe")->onDelete("cascade");
            $table->uuid('idClasse');
            $table-> foreign("idClasse")->references("id")->on("classeMatiereGroupe")->onDelete("cascade");
            $table->uuid('idGroupe');
            $table-> foreign("idGroupe")->references("id")->on("classeMatiereGroupe")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
