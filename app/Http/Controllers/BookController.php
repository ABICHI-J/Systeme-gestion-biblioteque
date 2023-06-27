<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livres = Book::all();

        // dd($livres);

        return view('livres.index', compact('livres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = new Book();
        $book->title = $request->input('title');
        $book->author = $request->input('author');

        // Reste du code...

        $book->save();

        // Vérifier si l'utilisateur est authentifié et a emprunté le livre
        if (Auth::check() && $request->has('borrow')) {
            $user = Auth::user();
            $user->books()->attach($book->id); // Associer le livre à l'utilisateur
        }

        return redirect()->route('livres.index')->with('success', 'Livre créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupérer le livre depuis la base de données
        $livre = Book::findOrFail($id);

        // Récupérer la liste des utilisateurs depuis la base de données
        $users = User::all();

        // Passer les données du livre et la liste des utilisateurs à la vue
        return view('livres.show', compact('livre', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupérer le livre depuis la base de données
        $livre = Book::findOrFail($id);

        // Passer les données du livre à la vue
        return view('livres.edit', compact('livre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $livre)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
        ]);

        // Mettre à jour le livre avec les données validées
        $livre->update($validatedData);

        // Rediriger vers la page de détails du livre
        return redirect()->route('livres.show', $livre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $livre)
    {
        // Supprimer le livre de la base de données
        $livre->delete();

        // Rediriger vers une page appropriée, par exemple la liste des livres
        return redirect()->route('livres.index');
    }
}
