<x-layout title="admin solve editor">
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-[#F5F6F2]">
            {{ __('Edit Solve') }} - {{ $solve->user->name ?? 'Unknown User' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-lg border border-[#3A424C] bg-[#181C21] shadow-[5px_5px_0_rgba(40,116,208,0.35)]">
                <div class="p-6 text-[#F5F6F2]">

                    <form action="{{ route('admin.solves.update', $solve) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="scramble" class="block text-sm font-medium text-[#F5F6F2]">Scramble</label>
                            <input type="text" name="scramble" id="scramble"
                                   value="{{ old('scramble', $solve->scramble) }}"
                                   class="mt-1 block w-full rounded-md border border-[#3A424C] bg-[#20262D] text-[#F5F6F2] shadow-sm focus:border-[#2874D0] focus:ring-[#2874D0]"
                                   required>
                            @error('scramble') <span class="text-xs text-[#D62839]">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="time_ms" class="block text-sm font-medium text-[#F5F6F2]">Time
                                (in milliseconds)</label>
                            <input type="number" name="time_ms" id="time_ms"
                                   value="{{ old('time_ms', $solve->time_ms) }}"
                                   class="mt-1 block w-full rounded-md border border-[#3A424C] bg-[#20262D] text-[#F5F6F2] shadow-sm focus:border-[#2874D0] focus:ring-[#2874D0]"
                                   required>
                            <p class="mt-1 text-sm text-[#AEB6C1]">Current
                                time: {{ number_format($solve->time_ms / 1000, 2) }} seconds</p>
                            @error('time_ms') <span class="text-xs text-[#D62839]">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit"
                                    class="rounded border-2 border-[#F5F6F2] bg-[#D62839] px-4 py-2 font-bold text-[#F5F6F2] shadow-[3px_3px_0_#2874D0] hover:bg-[#F4C430] hover:text-[#101214]">
                                Save Changes
                            </button>
                            <a href="{{ route('admin.solves') }}"
                               class="inline-flex items-center text-[#AEB6C1] hover:text-[#F5F6F2]">
                                Cancel
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-layout>
