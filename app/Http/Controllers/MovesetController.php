<?php

namespace App\Http\Controllers;

use App\Models\Method;
use App\Models\Moveset;
use Illuminate\Http\Request;
use function Laravel\Prompts\title;


class MovesetController
{
    public function index(Request $request)
    {
        $movesets = Moveset::query()
            ->with('method')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('algorithm', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('methods'), function ($query) use ($request) {
                $query->whereIn('method_id', $request->input('methods'));
            })
            ->latest()
            ->get();

        $methods = Method::orderBy('name')->get();

        return view('movesets.index', compact('movesets', 'methods'));
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
            'method_id' => 'required|exists:methods,id',
        ]);


        $moveset = new Moveset();
        $moveset->name = $request->input('name');
        $moveset->description = $request->input('description');
        $moveset->num_moves = $request->input('num_moves');
        $moveset->algorithm = $request->input('algorithm');
        $moveset->method_id = $request->input('method_id');
        $moveset->user_id = auth()->user()->id;
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
        $this->delete();
    }
}
