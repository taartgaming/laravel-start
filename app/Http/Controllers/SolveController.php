<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solve;

class SolveController extends Controller
{
    public function index()
    {
        $leaderboard = Solve::query()
            ->with('user:id,name')
            ->where('accepted', true)
            ->orderBy('time_ms')
            ->latest('created_at')
            ->limit(10)
            ->get();

        return view('solves.timer', compact('leaderboard'));
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
