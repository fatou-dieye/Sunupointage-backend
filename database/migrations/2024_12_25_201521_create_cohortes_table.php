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
        Schema::create('cohortes', function (Blueprint $table) {
            
                    $table->id();
                    $table->string('nom');
                    $table->text('description')->nullable();
                    $table->string('responsable_cohorte');
                    $table->integer('nombre_personnes');
                    $table->date('date_debut');
                    $table->date('date_fin');
                    $table->time('heure_entree');
                    $table->time('heure_sortie');
                    $table->timestamps();
                });
            }
            
        

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cohortes');
    }
};
