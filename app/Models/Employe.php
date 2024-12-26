<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent; // Importez le bon modèle MongoDB

class Employe extends Eloquent
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'adresse',
        'fonction',
        'departement',
        'card_id',
        'role',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
