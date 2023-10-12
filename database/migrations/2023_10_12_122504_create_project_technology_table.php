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
        Schema::create('project_technology', function (Blueprint $table) {
            //vado a creare la colonna technolory_id e a renderla una foreign_key
            $table->unsignedBigInteger('technology_id');
            $table->foreign('technology_id')
            ->references('id')
            ->on('technologies');

            //vado a creare la colonna project_id e a renderla una foreign_key
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')
            ->references('id')
            ->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
