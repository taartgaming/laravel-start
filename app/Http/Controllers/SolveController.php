<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solve;

class SolveController extends Controller
{
    public function index()
    {
        return view('solves.timer');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'scramble' => 'required|string',
            'time_ms' => 'required|integer|min:0',
        ]);
        $request->user()->solves()->create($validated);


        return response()->json(['message' => 'Solve saved successfully!']);
    }
}
