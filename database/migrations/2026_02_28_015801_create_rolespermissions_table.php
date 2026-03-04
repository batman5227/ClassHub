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
        Schema::create('rolespermissions', function (Blueprint $table) {
             $table->uuid('id')
                ->primary()
                ->default(DB::raw('uuid_generate_v4()'));
             $table->uuid('roleId');
            $table->uuid('permissionId');

            $table->foreign('roleId')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade');

            $table->foreign('permissionId')
                  ->references('id')
                  ->on('permissions')
                  ->onDelete('cascade');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rolespermissions');
    }
};
