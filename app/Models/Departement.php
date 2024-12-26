<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent; // Utilisez cette classe

class Departement extends Eloquent
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'name',
        'description',
        'responsable_departement',
        'nombre_personne',
        'annee',
        'heure_entrée',
        'heure_sortie'
    ];
}


