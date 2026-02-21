<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRoleUsersTable extends Migration
{
    public function up()
    {
        // Extension PostgreSQL pour UUID
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');

        Schema::create('role_users', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));

            $table->uuid('idRole');
            $table->uuid('idUsers');

            $table->foreign('idRole')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade');

            $table->foreign('idUsers')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_users');
    }
}
