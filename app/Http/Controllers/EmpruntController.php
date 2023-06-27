<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Emprunt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpruntController extends Controller
{
    public function emprunter(Request $request, Book $livre)
    {
        // Récupérer l'utilisateur actuellement authentifié
        $user = Auth::user();

        // Vérifier si l'utilisateur a déjà emprunté 5 livres ce mois-ci
        $borrowCount = Emprunt::where('user_id', $user->id)
            ->whereMonth('created_at', now()->month)
            ->count();

        if ($borrowCount >= 5) {
            return redirect()->back()->withErrors(['limite_emprunts' => 'Vous avez déjà atteint la limite d\'emprunt de livres pour ce mois.']);
        }

        // Vérifier si le livre est disponible
        if ($livre->is_borrowed) {
            return redirect()->back()->withErrors(['livre_deja_emprunte' => 'Ce livre est déjà emprunté.']);
        }

        // Créer l'emprunt
        $emprunt = new Emprunt();
        $emprunt->user_id = $user->id;
        $emprunt->book_id = $livre->id;
        $emprunt->save();

        // Marquer le livre comme emprunté
        $livre->is_borrowed = true;
        $livre->user_id = $user->id; // Mettre à jour le user_id du livre
        $livre->save();

        return redirect()->back()->with('success_emprunt', 'Livre emprunté avec succès.');
    }

    public function returnBook(Request $request, Book $livre)
    {
        $user = Auth::user();

        // Recherche de l'emprunt correspondant à l'utilisateur et au livre
        $emprunt = Emprunt::where('user_id', $user->id)
            ->where('book_id', $livre->id)
            ->whereNull('date_retour_effective')
            ->first();

        if (!$emprunt) {
            return redirect()->back()->with('error', 'Vous n\'avez pas emprunté ce livre.');
        }

        // Mettre à jour la date de retour de l'emprunt
        $emprunt->date_retour_effective = now();
        $emprunt->save();

        // Mettre à jour l'état du livre comme non emprunté
        $livre->is_borrowed = false;
        $livre->save();

        return redirect()->back()->with('success_retour', 'Livre retourné avec succès.');
    }

}

