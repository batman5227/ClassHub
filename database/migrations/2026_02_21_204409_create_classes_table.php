<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateClassesTable extends Migration
{
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');

        Schema::create('classes', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->string('nom');
            // Dans la migration des classes, ajoutez :
$table->uuid('idAnneeScolaire')->nullable();
$table->foreign('idAnneeScolaire')
      ->references('id')
      ->on('annee_scolaires')
      ->onDelete('set null');

            $table->uuid('idSites');
            $table->foreign('idSites')
                  ->references('id')
                  ->on('sites')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
