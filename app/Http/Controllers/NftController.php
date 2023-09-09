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
            'image' => 'required|string|max:255',
            'proprietaire_id' => 'nullable|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id'
        ]);

        Nft::create($request->all());

        return redirect()->route('nfts.index')->with('success','NFT créé avec succès.');
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
            'adresse' => 'required|string|unique:nfts,adresse,'.$id,
            'token_standard' => 'required|in:ERC-721,ERC-1155,ERC-998',
            'price' => 'required|numeric',
            'image' => 'required|string|max:255',
            'proprietaire_id' => 'nullable|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id'
        ]);

        Nft::find($id)->update($request->all());

        return redirect()->route('nfts.index')->with('success','NFT mis à jour avec succès');
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

        return redirect()->route('nfts.index')->with('success','NFT supprimé avec succès');
    }
}
