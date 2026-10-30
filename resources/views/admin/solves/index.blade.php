<x-layout title="admin-solves">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Solves') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Success Message Alert -->
            @if (session('status'))
                <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-100">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">

                    <table class="min-w-full text-left text-sm">
                        <thead class="border-b dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th class="px-4 py-3 font-semibold">User</th>
                            <th class="px-4 py-3 font-semibold">Scramble</th>
                            <th class="px-4 py-3 font-semibold">Time (sec)</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                            <th class="px-4 py-3 font-semibold text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y dark:divide-gray-700">
                        @foreach ($solves as $solve)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors"
                                x-data="{ editMode: false }">
                                <td class="px-4 py-3">{{ $solve->user->name ?? 'Unknown' }}</td>

                                <td class="px-4 py-3" x-show="!editMode">
                                    <span
                                        class="font-mono text-xs text-gray-500 dark:text-gray-400">{{ $solve->scramble }}</span>
                                </td>

                                <td class="px-4 py-3 font-bold" x-show="!editMode">
                                    {{ number_format($solve->time_ms / 1000, 2) }}s
                                </td>

                                <td class="px-4 py-3" x-show="!editMode">
                                    @if ($solve->accepted)
                                        <span
                                            class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-200">Accepted</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-200">Pending</span>
                                    @endif
                                </td>

                                <td colspan="3" x-show="editMode" x-cloak>
                                    <form id="edit-form-{{ $solve->id }}"
                                          action="{{ route('admin.solves.update', $solve) }}" method="POST"
                                          class="flex gap-2 items-center w-full">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="scramble" value="{{ $solve->scramble }}"
                                               class="w-full text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm">
                                        <div class="flex items-center gap-1">
                                            <input type="number" name="time_ms" value="{{ $solve->time_ms }}"
                                                   class="w-24 text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm">
                                            <span class="text-xs text-gray-500">ms</span>
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
                                                        class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 font-medium">
                                                    Accept
                                                </button>
                                            </form>
                                        @endif

                                        <button @click="editMode = true" type="button"
                                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                            Edit
                                        </button>

                                        <form action="{{ route('admin.solves.destroy', $solve) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this solve?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 font-medium">
                                                Remove
                                            </button>
                                        </form>
                                    </div>

                                    <div x-show="editMode" x-cloak class="flex justify-end gap-2">
                                        <button type="submit" form="edit-form-{{ $solve->id }}"
                                                class="text-green-600 hover:text-green-800 font-medium">Save
                                        </button>
                                        <button @click="editMode = false" type="button"
                                                class="text-gray-500 hover:text-gray-700 font-medium">Cancel
                                        </button>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @if($solves->isEmpty())
                        <div class="py-6 text-center text-gray-500">
                            No solves found in the database.
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-layout>
