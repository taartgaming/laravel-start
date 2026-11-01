<x-layout title="Manage Movesets">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <div class="mb-6 flex items-end justify-between gap-4">
            <div>
                @can('access-admin')
                    <h2 class="text-2xl font-bold text-[#F5F6F2]">Admin: Manage Movesets</h2>
                @endcan

                @can('access-creator')
                    <h2 class="text-2xl font-bold text-[#F5F6F2]">Creator: Manage Movesets</h2>
                @endcan
            </div>
            <a href="{{ route('dashboard', ['tab' => 'admin']) }}"
               class="font-bold text-[#AEB6C1] hover:text-[#F4C430]">Back to dashboard</a>
        </div>

        @can('access-admin-or-creator')
            <div class="mb-4">
                <a href="{{ route('moveset.create') }}"
                    class="rounded border-2 border-[#F5F6F2] bg-[#D62839] px-6 py-3 font-bold text-[#F5F6F2] shadow-[3px_3px_0_#2874D0] transition-colors hover:bg-[#F4C430] hover:text-[#101214]">
                    Create New Moveset
                </a>
            </div>
        @endcan

        @if (session('status'))
            <div class="mb-4 rounded-lg border border-[#2874D0] bg-[#2874D0]/15 p-4 text-[#F5F6F2]">
                {{ session('status') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-lg border border-[#3A424C] bg-[#181C21] shadow-[5px_5px_0_rgba(40,116,208,0.35)]">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b border-[#3A424C] bg-[#20262D] text-[#F5F6F2]">
                <tr>
                    <th class="px-4 py-3">Created By</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Algorithm</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-[#3A424C] text-[#F5F6F2]">
                @foreach ($movesets as $moveset)
                    <tr class="transition-colors hover:bg-[#20262D]">
                        <td class="px-4 py-3">{{ $moveset->user?->name ?? 'System' }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $moveset->name }}</td>
                        <td class="px-4 py-3 font-mono text-xs text-[#AEB6C1]">{{ $moveset->algorithm }}</td>

                        <!-- Status Badge -->
                        <td class="px-4 py-3">
                            @if($moveset->is_active)
                                <span class="rounded-full bg-[#2874D0] px-2 py-1 text-xs font-semibold text-[#F5F6F2]">Active</span>
                            @else
                                <span class="rounded-full bg-[#D62839] px-2 py-1 text-xs font-semibold text-[#F5F6F2]">Inactive</span>
                            @endif
                        </td>

                        <td class="flex justify-end gap-2 px-4 py-3">
                            <a href="{{ route('dashboard.movesets.edit', $moveset) }}" class="rounded border border-[#2874D0] px-3 py-1 text-xs font-bold text-[#2874D0] transition-colors hover:bg-[#2874D0] hover:text-[#F5F6F2]">Edit</a>
                            <form action="{{ route('moveset.destroy', $moveset) }}" method="POST" onsubmit="return confirm('Delete this moveset?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded border border-[#D62839] px-3 py-1 text-xs font-bold text-[#D62839] transition-colors hover:bg-[#D62839] hover:text-[#F5F6F2]">Delete</button>
                            </form>
                            @if(auth()->user()->role === 'admin')
                                <form action="{{ route('admin.movesets.toggle', $moveset) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="rounded border border-[#F5F6F2] px-3 py-1 text-xs font-bold text-[#101214] transition-colors {{ $moveset->is_active ? 'bg-[#F4C430] hover:bg-[#EF8B2C]' : 'bg-[#2874D0] text-[#F5F6F2] hover:bg-[#F4C430] hover:text-[#101214]' }}">
                                        {{ $moveset->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
