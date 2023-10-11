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
        Schema::table('projects', function (Blueprint $table) {
            
            // crea la colonna del foreign
            $table->unsignedBigInteger('type_id')->nullable()->after('slug');

            //Rendo la colonna di tipo foreign-key
            $table->foreign('type_id')
            //Che fa riferimento alla colonna id della tabella types
            ->references('id')
            //Si specifica la tabella 
            ->on('types')
            //Se l'utente viene cancellato allora i progetti inseriti verrano eliminati
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            //Prima rimuoviamo la foreign key tramite il nome dell'indice assegnato automaticamente che troviamo sul server
            $table->dropForeign('projects_type_id_foreign');

            //Rimuovo la colonna type_id
            $table->dropColumn('type_id');
        });
    }
};
