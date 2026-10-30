<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solve;

class AdminSolveController extends Controller
{
    public function index()
    {
        $solves = Solve::with('user')->latest()->get();
        return view('admin.solves.index', compact('solves'));
    }

    public function accept(Solve $solve)
    {
        $solve->update(['accepted' => true]);
        return back()->with('status', 'Solve accepted successfully.');
    }

    public function update(Request $request, Solve $solve)
    {
        $request->validate([
            'time_ms' => 'required|integer|min:1',
            'scramble' => 'required|string',
        ]);

        $solve->update([
            'time_ms' => $request->time_ms,
            'scramble' => $request->scramble,
        ]);

        return back()->with('status', 'Solve updated successfully.');
    }

    public function edit(Solve $solve)
    {
        return view('admin.solves.edit', compact('solve'));
    }

    public function destroy(Solve $solve)
    {
        $solve->delete();
        return back()->with('status', 'Solve removed.');
    }
}
