<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\moveset;

class AdminMovesetController extends Controller
{
    public function index()
    {
        $movesets = Moveset::with('user')
            ->when(auth()->user()->role !== 'admin', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('admin.movesets.index', compact('movesets'));
    }

    public function toggleStatus(Moveset $moveset)
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        $moveset->is_active = !$moveset->is_active;
        $moveset->save();


        return back()->with('status', 'Moveset status updated successfully!');
    }

    public function update(Request $request)
    {

    }

    public function edit()
    {

    }

    public function destroy()
    {

    }
}
