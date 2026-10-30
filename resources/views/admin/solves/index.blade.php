<x-layout title="admin-solves">
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-[#F5F6F2]">
            {{ __('Manage Solves') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Success Message Alert -->
            @if (session('status'))
                <div class="mb-4 rounded-lg border border-[#2874D0] bg-[#2874D0]/15 p-4 text-[#F5F6F2]">
                    {{ session('status') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-lg border border-[#3A424C] bg-[#181C21] shadow-[5px_5px_0_rgba(40,116,208,0.35)]">
                <div class="overflow-x-auto p-6 text-[#F5F6F2]">

                    <table class="min-w-full text-left text-sm">
                        <thead class="border-b border-[#3A424C] bg-[#20262D]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">User</th>
                            <th class="px-4 py-3 font-semibold">Scramble</th>
                            <th class="px-4 py-3 font-semibold">Time (sec)</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                            <th class="px-4 py-3 font-semibold text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-[#3A424C]">
                        @foreach ($solves as $solve)
                            <tr class="transition-colors hover:bg-[#20262D]"
                                x-data="{ editMode: false }">
                                <td class="px-4 py-3">{{ $solve->user->name ?? 'Unknown' }}</td>

                                <td class="px-4 py-3" x-show="!editMode">
                                    <span
                                        class="font-mono text-xs text-[#AEB6C1]">{{ $solve->scramble }}</span>
                                </td>

                                <td class="px-4 py-3 font-bold" x-show="!editMode">
                                    {{ number_format($solve->time_ms / 1000, 2) }}s
                                </td>

                                <td class="px-4 py-3" x-show="!editMode">
                                    @if ($solve->accepted)
                                        <span
                                            class="rounded-full bg-[#2874D0] px-2 py-1 text-xs font-semibold text-[#F5F6F2]">Accepted</span>
                                    @else
                                        <span
                                            class="rounded-full bg-[#F4C430] px-2 py-1 text-xs font-semibold text-[#101214]">Pending</span>
                                    @endif
                                </td>

                                <td colspan="3" x-show="editMode" x-cloak>
                                    <form id="edit-form-{{ $solve->id }}"
                                          action="{{ route('admin.solves.update', $solve) }}" method="POST"
                                          class="flex gap-2 items-center w-full">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="scramble" value="{{ $solve->scramble }}"
                                               class="w-full rounded-md border border-[#3A424C] bg-[#20262D] text-sm text-[#F5F6F2] shadow-sm focus:border-[#2874D0] focus:ring-[#2874D0]">
                                        <div class="flex items-center gap-1">
                                            <input type="number" name="time_ms" value="{{ $solve->time_ms }}"
                                                  class="w-24 rounded-md border border-[#3A424C] bg-[#20262D] text-sm text-[#F5F6F2] shadow-sm focus:border-[#2874D0] focus:ring-[#2874D0]">
                                              <span class="text-xs text-[#AEB6C1]">ms</span>
                                        </div>
                                    </form>
                                </td>

                                <td class="px-4 py-3 text-right space-x-2 whitespace-nowrap">

                                    <div x-show="!editMode" class="flex justify-end gap-2">
                                        @if (!$solve->accepted)
                                            <form action="{{ route('admin.solves.accept', $solve) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="font-medium text-[#2874D0] hover:text-[#F4C430]">
                                                    Accept
                                                </button>
                                            </form>
                                        @endif

                                        <button @click="editMode = true" type="button"
                                                class="font-medium text-[#2874D0] hover:text-[#F4C430]">
                                            Edit
                                        </button>

                                        <form action="{{ route('admin.solves.destroy', $solve) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this solve?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="font-medium text-[#D62839] hover:text-[#EF8B2C]">
                                                Remove
                                            </button>
                                        </form>
                                    </div>

                                    <div x-show="editMode" x-cloak class="flex justify-end gap-2">
                                        <button type="submit" form="edit-form-{{ $solve->id }}"
                                                class="font-medium text-[#2874D0] hover:text-[#F4C430]">Save
                                        </button>
                                        <button @click="editMode = false" type="button"
                                                class="font-medium text-[#AEB6C1] hover:text-[#F5F6F2]">Cancel
                                        </button>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @if($solves->isEmpty())
                        <div class="py-6 text-center text-[#AEB6C1]">
                            No solves found in the database.
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-layout>
