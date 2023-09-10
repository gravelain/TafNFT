<?php

namespace App\Http\Controllers;

use App\Models\Nft;
use Illuminate\Http\Request;

class NftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nfts = Nft::all();
        return view('home')->with('nfts', $nfts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'artiste' => 'required|string',
            'description' => 'required|string|max:255',
            'adresse' => 'required|string|unique:nfts',
            'token_standard' => 'required|in:ERC-721,ERC-1155,ERC-998',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ajout des règles pour l'image
            'proprietaire_id' => 'nullable|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Traitement de l'image téléchargée
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Assurez-vous que le répertoire public/images existe
            $imagePath = 'images/' . $imageName;
        }

        // Enregistrement du NFT avec le chemin de l'image dans la base de données
        Nft::create([
            'title' => $request->input('title'),
            'artiste' => $request->input('artiste'),
            'description' => $request->input('description'),
            'adresse' => $request->input('adresse'),
            'token_standard' => $request->input('token_standard'),
            'price' => $request->input('price'),
            'image' => $imagePath, // Chemin de l'image dans le stockage
            'proprietaire_id' => $request->input('proprietaire_id'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('nfts.index')->with('success', 'NFT créé avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $nft = Nft::find($id);

        if (!$nft) {
            return redirect()->route('nfts.index')->with('error', 'NFT non trouvé');
        }

        return view('nfts.show', compact('nft'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'artiste' => 'required|string',
            'description' => 'required|string|max:255',
            'adresse' => 'required|string|unique:nfts,adresse,' . $id,
            'token_standard' => 'required|in:ERC-721,ERC-1155,ERC-998',
            'price' => 'required|numeric',
            'image' => 'required|string|max:255',
            'proprietaire_id' => 'nullable|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        Nft::find($id)->update($request->all());

        return redirect()->route('nfts.index')->with('success', 'NFT mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nft = Nft::find($id);

        if (!$nft) {
            return redirect()->route('nfts.index')->with('error', 'NFT non trouvé');
        }

        $nft->delete();

        return redirect()->route('nfts.index')->with('success', 'NFT supprimé avec succès');
    }
}
