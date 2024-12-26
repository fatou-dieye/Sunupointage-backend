<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartementsTable  extends Migration
{
    public function up()
    {
        // Créer la collection 'departements' dans MongoDB
        Schema::create('departements', function (Blueprint $table) {
            $table->id(); // Identifiant unique
            $table->string('nom'); // Le nom du département
            $table->string('description')->nullable(); // Description du département
            $table->string('responsable_departement')->nullable(); // Responsable du département
            $table->integer('nombre_personne')->default(0); // Nombre d'employés ou apprenants
            $table->integer('annee')->nullable(); // Année de création ou autre contexte
            $table->time('heure_debut')->nullable(); // Heure de début
            $table->time('heure_fin')->nullable(); // Heure de fin
            $table->timestamps(); // Horodatage
        });
    }

    public function down()
    {
        // Supprimer la collection 'departements' si elle existe
        Schema::dropIfExists('departements');
    }
}




