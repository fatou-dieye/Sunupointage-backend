<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeController extends Controller
{
    // Créer un employé
    public function create(Request $request)
    {
        // Vérifier si l'email existe déjà
        $existingEmail = Employe::where('email', $request->email)->first();
        if ($existingEmail) {
            return response()->json(['message' => 'Cet email est déjà utilisé.'], 400);
        }

        // Vérifier si le téléphone existe déjà
        $existingPhone = Employe::where('telephone', $request->telephone)->first();
        if ($existingPhone) {
            return response()->json(['message' => 'Ce numéro de téléphone est déjà attribué.'], 400);
        }

        // Valider les autres informations
        $validated = $request->validate([
            'email' => 'required|email',
            'telephone' => 'required|string',
            'adresse' => 'required|string|max:255',
            'fonction' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'card_id' => 'nullable|string|unique:employees,card_id',
            'role' => 'required|string|in:admin,utilisateur',
            'password' => 'required|string|min:6',
        ]);

        // Hacher le mot de passe
        $validated['password'] = Hash::make($validated['password']);

        // Créer l'employé
        $employe = Employe::create($validated);

        return response()->json(['message' => 'Employé créé avec succès', 'employe' => $employe], 201);
    }

    public function update(Request $request, $id)
    {
        $employe = Employe::findOrFail($id);
    
        // Vérification si l'email est unique
        $existingEmail = Employe::where('email', $request->email)
                                ->where('id', '!=', $employe->id)
                                ->first();
        if ($existingEmail) {
            return response()->json(['message' => 'Cet email est déjà utilisé.'], 400);
        }
    
        // Vérification si le téléphone est unique
        $existingPhone = Employe::where('telephone', $request->telephone)
                                ->where('id', '!=', $employe->id)
                                ->first();
        if ($existingPhone) {
            return response()->json(['message' => 'Ce numéro de téléphone est déjà attribué.'], 400);
        }
    
        // Validation des données
        $validated = $request->only([
            'nom', 'email', 'telephone', 'adresse', 'fonction', 'departement', 'card_id', 'role', 'password'
        ]);
    
        // Si le mot de passe est présent, le hacher
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
    
        // Mise à jour de l'employé
        $employe->update($validated);
    
        // Rafraîchissement de l'employé pour récupérer les données actuelles
        $employe->refresh();
    
        return response()->json(['message' => 'Employé mis à jour avec succès', 'employe' => $employe], 200);
    }
    

    

    // Lister tous les employés
    public function list(Request $request)
    {
        $employees = Employe::query();

        if ($request->has('is_active')) {
            $employees->where('is_active', $request->is_active);
        }

        return response()->json($employees->get(), 200);
    }

    // Afficher un employé par ID
    public function show($id)
    {
        $employe = Employe::find($id);

        if (!$employe) {
            return response()->json(['message' => 'Employé non trouvé'], 404);
        }

        return response()->json($employe, 200);
    }


    // Bloquer un ou plusieurs employés
    public function block(Request $request)
    {
        // Valider les identifiants (peut être un tableau ou une valeur unique)
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|exists:employes,id',
        ]);

        // Bloquer les employés
        Employe::whereIn('id', $validated['ids'])->update(['is_active' => false]);

        return response()->json(['message' => 'Employé(s) bloqué(s) avec succès'], 200);
    }

    // Bloquer un employé
    public function blockOne($id)
    {
        $employe = Employe::find($id);

        if (!$employe) {
            return response()->json(['message' => 'Employé non trouvé'], 404);
        }

        $employe->update(['is_active' => false]);

        return response()->json(['message' => 'Employé bloqué avec succès', 'employe' => $employe], 200);
    }

    // Supprimer un ou plusieurs employés
    public function delete(Request $request)
    {
        // Valider les identifiants (peut être un tableau ou une valeur unique)
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|exists:employes,id',
        ]);

        // Supprimer les employés
        Employe::whereIn('id', $validated['ids'])->delete();

        return response()->json(['message' => 'Employé(s) supprimé(s) avec succès'], 200);
    }

    // Supprimer un employé
    public function deleteOne($id)
    {
        $employe = Employe::find($id);

        if (!$employe) {
            return response()->json(['message' => 'Employé non trouvé'], 404);
        }

        $employe->delete();

        return response()->json(['message' => 'Employé supprimé avec succès'], 200);
    }
}

