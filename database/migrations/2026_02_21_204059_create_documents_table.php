<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');

       Schema::create('documents', function (Blueprint $table) {
    $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
    $table->string('nom');
    $table->uuid('idMatiere')->nullable(); // nullable pour les docs sans parent
    $table->rememberToken();
    $table->timestamps();
});

// FK auto-référencée ajoutée après création de la table
Schema::table('documents', function (Blueprint $table) {
    $table->foreign('idMatiere')->references('id')->on('documents')->onDelete('cascade');
});
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
