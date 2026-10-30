<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\moveset;

class AdminMovesetController extends Controller
{
    public function index()
    {
        $movesets = Moveset::with('user')->latest()->get();
        return view('admin.movesets.index', compact('movesets'));
    }

    public function toggleStatus(Moveset $moveset)
    {

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
