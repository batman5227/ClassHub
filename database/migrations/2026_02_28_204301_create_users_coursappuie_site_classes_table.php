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
        Schema::create('users_coursappuie_site_classes', function (Blueprint $table) {
            $table->uuid('id')
                ->primary()
                ->default(DB::raw('uuid_generate_v4()'));
             $table->uuid('userId')->nullable();
            $table->uuid('classeId')->nullable();
             $table->uuid('siteId')->nullable();
             $table->uuid('coursAppuieId')->nullable();
             $table->foreign('userId')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

             $table->foreign('classeId')
                  ->references('id')
                  ->on('classes')
                  ->onDelete('cascade');

             $table->foreign('siteId')
                  ->references('id')
                  ->on('sites')
                  ->onDelete('cascade');

             $table->foreign('coursAppuieId')
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
        Schema::dropIfExists('users_coursappuie_site_classes');
    }
};
