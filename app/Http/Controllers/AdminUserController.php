<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $users = User::withCount([
            'solves',
            'solves as accepted_solves_count' => fn ($query) => $query->where('accepted', true),
            'movesets',
        ])->orderBy('name')->get();

        return view('admin.users.index', compact('users'));
    }

    public function demote(User $user): RedirectResponse
    {
        abort_if($user->is(auth()->user()), 422, 'You cannot demote yourself.');
        abort_if($user->role === 'admin', 422, 'Administrators cannot be demoted.');

        $user->role = 'user';
        $user->save();
        $user->movesets()->update(['is_active' => false]);

        return back()->with('status', "{$user->name} was demoted to user.");
    }

    public function unacceptRuns(User $user): RedirectResponse
    {
        abort_if($user->is(auth()->user()), 422, 'You cannot change your own runs here.');

        $user->solves()->where('accepted', true)->update(['accepted' => false]);
        $user->tryCreator();

        return back()->with('status', "All accepted runs belonging to {$user->name} were unaccepted.");
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_if($user->is(auth()->user()), 422, 'You cannot delete yourself.');
        abort_if($user->role === 'admin', 422, 'Administrators cannot be deleted.');

        DB::transaction(function () use ($user): void {
            $user->movesets()->update(['user_id' => null]);
            $user->delete();
        });

        return back()->with('status', 'User deleted. Their movesets were kept and are now system-owned.');
    }
}