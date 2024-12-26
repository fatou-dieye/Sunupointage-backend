<?php

use Illuminate\Http\Request;
use App\Http\Controllers\DepartementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CohorteController;
use App\Http\Controllers\EmployeController;



    



Route::get('/departments', [DepartementController::class, 'index']);  // Liste des départements
Route::post('/departments/create', [DepartementController::class, 'store']);  // Créer un département
Route::get('/departments/{department}', [DepartementController::class, 'show']);  // Afficher un département spécifique
Route::put('/departments/update/{department}', [DepartementController::class, 'update']);  // Mettre à jour un département
Route::delete('/departments/delete/{department}', [DepartementController::class, 'destroy']);  // Supprimer un département
Route::post('/departments/bulk-delete', [DepartementController::class, 'bulkDelete']);  // Supprimer plusieurs départements




// Liste de toutes les cohortes
Route::get('/cohortes', [CohorteController::class, 'index']);

// Créer une nouvelle cohorte
Route::post('/cohortes/create', [CohorteController::class, 'store']);

// Afficher une cohorte spécifique
Route::get('/cohortes/{cohorte}', [CohorteController::class, 'show']);

// Modifier une cohorte
Route::put('/cohortes/update/{cohorte}', [CohorteController::class, 'update']);

// Supprimer une cohorte
Route::delete('/cohortes/delete/{cohorte}', [CohorteController::class, 'destroy']);

// Supprimer plusieurs cohortes en une seule requête
Route::delete('/cohortes/bulk-delete', [CohorteController::class, 'bulkDelete']);





Route::prefix('employe')->group(function () {
    // Créer un employé
    Route::post('/create', [EmployeController::class, 'create']);
    // Modifier un employé
    Route::put('/update/{id}', [EmployeController::class, 'update']);
    
    // Afficher un employé par ID
    Route::get('/show/{id}', [EmployeController::class, 'show']);
    // Lister tous les employés
    Route::get('/list', [EmployeController::class, 'list']);

     // Bloquer plusieurs employés
     Route::post('/block', [EmployeController::class, 'block']);
     // Bloquer un employé
     Route::post('/block/{id}', [EmployeController::class, 'blockOne']);
     // Supprimer plusieurs employés
     Route::delete('/delete', [EmployeController::class, 'delete']);
     // Supprimer un employé
     Route::delete('/delete/{id}', [EmployeController::class, 'deleteOne']);

});

