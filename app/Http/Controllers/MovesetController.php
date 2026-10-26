<?php

namespace App\Http\Controllers;

use App\Models\Moveset;
use Illuminate\Http\Request;
use function Laravel\Prompts\title;


class MovesetController
{
    public function index()
    {
        $firstMoveset = Moveset::first();
        $movesets = Moveset::all();

        $moveset = new Moveset();
        $moveset->name = 'Jb Perm';
        $moveset->num_moves = 13;
        $moveset->description = 'PLL algorithm that swaps two adjacent corners and two adjacent edges.';
        $moveset->algorithm = "R U R' F' R U R' U' R' F R2 U' R'";
        $moveset->user_id = auth()->id();
        return view('movesets.index', compact('moveset', 'movesets', 'firstMoveset'));
    }

    public function create()
    {
        return view('movesets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'num_moves' => 'required|numeric',
            'algorithm' => 'required|string',
        ]);


        $moveset = new Moveset();
        $moveset->name = $request->input('name');
        $moveset->description = $request->input('description');
        $moveset->num_moves = $request->input('num_moves');
        $moveset->algorithm = $request->input('algorithm');
        $moveset->save();


        return redirect()->route('moveset.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Moveset $moveset)
    {
        return view('movesets.show', compact('moveset'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
