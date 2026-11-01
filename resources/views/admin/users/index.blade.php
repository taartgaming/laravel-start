<x-layout title="Manage Users">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-[#F5F6F2]">Manage Users</h1>
                <p class="mt-2 text-sm text-[#AEB6C1]">Review accounts and manage creator access.</p>
            </div>
            <a href="{{ route('dashboard', ['tab' => 'admin']) }}" class="font-bold text-[#AEB6C1] hover:text-[#F4C430]">Back to dashboard</a>
        </div>

        @if (session('status'))
            <div class="mb-6 rounded-lg border border-[#2874D0] bg-[#2874D0]/15 p-4 text-[#F5F6F2]">{{ session('status') }}</div>
        @endif

        <div class="overflow-x-auto rounded-lg border border-[#3A424C] bg-[#181C21] shadow-[5px_5px_0_rgba(40,116,208,0.35)]">
            <table class="min-w-full text-left text-sm text-[#F5F6F2]">
                <thead class="border-b border-[#3A424C] bg-[#20262D]">
                <tr>
                    <th class="px-4 py-3">Username</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Accepted runs</th>
                    <th class="px-4 py-3">Movesets</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-[#3A424C]">
                @foreach ($users as $account)
                    <tr class="hover:bg-[#20262D]">
                        <td class="px-4 py-3 font-semibold">{{ $account->name }}</td>
                        <td class="px-4 py-3 text-[#AEB6C1]">{{ $account->email }}</td>
                        <td class="px-4 py-3 capitalize">{{ $account->role }}</td>
                        <td class="px-4 py-3">{{ $account->accepted_solves_count }}</td>
                        <td class="px-4 py-3">{{ $account->movesets_count }}</td>
                        <td class="px-4 py-3">
                            @if ($account->id === auth()->id() || $account->role === 'admin')
                                <span class="block text-right text-[#AEB6C1]">Protected</span>
                            @else
                                <div class="flex flex-wrap justify-end gap-2">
                                    @if ($account->role === 'creator')
                                        <form method="POST" action="{{ route('admin.users.demote', $account) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="rounded border border-[#F4C430] px-3 py-1 font-bold text-[#F4C430] hover:bg-[#F4C430] hover:text-[#101214]">Demote</button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.users.unaccept-runs', $account) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button class="rounded border border-[#2874D0] px-3 py-1 font-bold text-[#2874D0] hover:bg-[#2874D0] hover:text-[#F5F6F2]">Unaccept runs</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.users.destroy', $account) }}" onsubmit="return confirm('Delete this user? Their movesets will be kept.');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded border border-[#D62839] px-3 py-1 font-bold text-[#D62839] hover:bg-[#D62839] hover:text-[#F5F6F2]">Delete</button>
                                    </form>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>