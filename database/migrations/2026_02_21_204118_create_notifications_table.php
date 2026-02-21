<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');

        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->string('titre');
            $table->text('message')->nullable();
            $table->uuid('idGroupe')->nullable(); // important
            $table->timestamps();
        });

        // FK ajoutée après création
        Schema::table('notifications', function (Blueprint $table) {
            $table->foreign('idGroupe')
                  ->references('id')
                  ->on('notifications')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
