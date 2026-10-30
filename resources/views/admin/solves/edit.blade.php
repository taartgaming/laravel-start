<x-layout title="admin solve editor">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Solve') }} - {{ $solve->user->name ?? 'Unknown User' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('admin.solves.update', $solve) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="scramble" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Scramble</label>
                            <input type="text" name="scramble" id="scramble"
                                   value="{{ old('scramble', $solve->scramble) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                   required>
                            @error('scramble') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="time_ms" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Time
                                (in milliseconds)</label>
                            <input type="number" name="time_ms" id="time_ms"
                                   value="{{ old('time_ms', $solve->time_ms) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                   required>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Current
                                time: {{ number_format($solve->time_ms / 1000, 2) }} seconds</p>
                            @error('time_ms') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Save Changes
                            </button>
                            <a href="{{ route('admin.solves') }}"
                               class="inline-flex items-center text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">
                                Cancel
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-layout>
