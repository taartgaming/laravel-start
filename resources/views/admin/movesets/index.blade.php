<x-layout title="admin-moveset">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="mb-4 text-2xl font-bold text-[#F5F6F2]">Admin: Manage Movesets</h2>

        @if (session('status'))
            <div class="mb-4 rounded-lg border border-[#2874D0] bg-[#2874D0]/15 p-4 text-[#F5F6F2]">
                {{ session('status') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-lg border border-[#3A424C] bg-[#181C21] shadow-[5px_5px_0_rgba(40,116,208,0.35)]">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b border-[#3A424C] bg-[#20262D] text-[#F5F6F2]">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Algorithm</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-[#3A424C] text-[#F5F6F2]">
                @foreach ($movesets as $moveset)
                    <tr class="transition-colors hover:bg-[#20262D]">
                        <td class="px-4 py-3">{{ $moveset->user->name ?? 'System' }}</td>
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

                        <td class="px-4 py-3 text-right flex justify-end gap-2">

                            <form action="{{ route('admin.movesets.toggle', $moveset) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="rounded border border-[#F5F6F2] px-3 py-1 text-xs font-bold text-[#101214] transition-colors {{ $moveset->is_active ? 'bg-[#F4C430] hover:bg-[#EF8B2C]' : 'bg-[#2874D0] text-[#F5F6F2] hover:bg-[#F4C430] hover:text-[#101214]' }}">
                                    {{ $moveset->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>


                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
