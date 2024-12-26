<?php




namespace App\Http\Controllers;

use App\Models\Cohorte;
use Illuminate\Http\Request;

class CohorteController extends Controller
{
    // Récupérer la liste de toutes les cohortes
    public function index()
    {
        $cohortes = Cohorte::all();
        return response()->json($cohortes);
    }

    // Créer une nouvelle cohorte
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'responsable_cohorte' => 'required|string|max:255',
            'nombre_personnes' => 'required|integer',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'heure_entree' => 'required|date_format:H:i',
            'heure_sortie' => 'required|date_format:H:i',
        ]);

        $cohorte = Cohorte::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'responsable_cohorte' => $request->responsable_cohorte,
            'nombre_personnes' => $request->nombre_personnes,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'heure_entree' => $request->heure_entree,
            'heure_sortie' => $request->heure_sortie,
        ]);

        return response()->json($cohorte, 201);
    }

    // Afficher une cohorte spécifique
    public function show($id)
    {
        $cohorte = Cohorte::find($id);

        if (!$cohorte) {
            return response()->json(['message' => 'Cohorte not found'], 404);
        }

        return response()->json($cohorte);
    }

    // Mettre à jour une cohorte
    public function update(Request $request, $id)
    {
        $cohorte = Cohorte::find($id);

        if (!$cohorte) {
            return response()->json(['message' => 'Cohorte not found'], 404);
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'responsable_cohorte' => 'required|string|max:255',
            'nombre_personnes' => 'required|integer',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'heure_entree' => 'required|date_format:H:i',
            'heure_sortie' => 'required|date_format:H:i',
        ]);

        $cohorte->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'responsable_cohorte' => $request->responsable_cohorte,
            'nombre_personnes' => $request->nombre_personnes,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'heure_entree' => $request->heure_entree,
            'heure_sortie' => $request->heure_sortie,
        ]);

        return response()->json($cohorte);
    }

    // Supprimer une cohorte
    public function destroy($id)
    {
        $cohorte = Cohorte::find($id);

        if (!$cohorte) {
            return response()->json(['message' => 'Cohorte not found'], 404);
        }

        $cohorte->delete();

        return response()->json(['message' => 'Cohorte deleted successfully']);
    }

    // Supprimer plusieurs cohortes en une seule requête
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;  // Attendez-vous à ce que les IDs soient passés en tableau

        if (empty($ids)) {
            return response()->json(['message' => 'No cohorte IDs provided'], 400);
        }

        Cohorte::whereIn('id', $ids)->delete();

        return response()->json(['message' => 'Cohortes deleted successfully']);
    }
}
