<x-layout title="Edit Moveset">
    <div class="mx-auto mt-12 max-w-2xl rounded-lg border border-[#3A424C] bg-[#181C21] p-8 shadow-[5px_5px_0_rgba(40,116,208,0.35)]">
        <h2 class="mb-8 text-center text-3xl font-extrabold tracking-wide text-[#F5F6F2]">Edit Moveset</h2>

        <form method="POST" action="{{ route('moveset.update', $moveset) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="method_id" class="mb-2 block text-sm font-medium text-[#F5F6F2]">Method</label>
                <select name="method_id" id="method_id" class="w-full appearance-none rounded-lg border border-[#3A424C] bg-[#20262D] px-4 py-3 text-[#F5F6F2] focus:border-[#F4C430] focus:outline-none focus:ring-1 focus:ring-[#F4C430]">
                    @foreach($methods as $method)
                        <option value="{{ $method->id }}" @selected(old('method_id', $moveset->method_id) == $method->id)>
                            {{ $method->description }}
                        </option>
                    @endforeach
                </select>
                @error('method_id') <p class="mt-1 text-sm text-[#D62839]">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="name" class="mb-2 block text-sm font-medium text-[#F5F6F2]">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $moveset->name) }}" class="w-full rounded-lg border border-[#3A424C] bg-[#20262D] px-4 py-3 text-[#F5F6F2] placeholder-[#AEB6C1] focus:border-[#F4C430] focus:outline-none focus:ring-1 focus:ring-[#F4C430]" required>
                @error('name') <p class="mt-1 text-sm text-[#D62839]">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="num_moves" class="mb-2 block text-sm font-medium text-[#F5F6F2]">Number of Moves</label>
                    <input type="number" name="num_moves" id="num_moves" value="{{ old('num_moves', $moveset->num_moves) }}" class="w-full rounded-lg border border-[#3A424C] bg-[#20262D] px-4 py-3 text-[#F5F6F2] focus:border-[#F4C430] focus:outline-none focus:ring-1 focus:ring-[#F4C430]" required>
                    @error('num_moves') <p class="mt-1 text-sm text-[#D62839]">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="algorithm" class="mb-2 block text-sm font-medium text-[#F5F6F2]">Algorithm</label>
                    <input type="text" name="algorithm" id="algorithm" value="{{ old('algorithm', $moveset->algorithm) }}" class="w-full rounded-lg border border-[#3A424C] bg-[#20262D] px-4 py-3 font-mono text-[#F5F6F2] focus:border-[#F4C430] focus:outline-none focus:ring-1 focus:ring-[#F4C430]" required>
                    @error('algorithm') <p class="mt-1 text-sm text-[#D62839]">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="description" class="mb-2 block text-sm font-medium text-[#F5F6F2]">Description</label>
                <textarea name="description" id="description" rows="3" class="w-full resize-y rounded-lg border border-[#3A424C] bg-[#20262D] px-4 py-3 text-[#F5F6F2] focus:border-[#F4C430] focus:outline-none focus:ring-1 focus:ring-[#F4C430]" required>{{ old('description', $moveset->description) }}</textarea>
                @error('description') <p class="mt-1 text-sm text-[#D62839]">{{ $message }}</p> @enderror
            </div>

            <div class="flex flex-wrap gap-4 pt-4">
                <button type="submit" class="rounded-lg border-2 border-[#F5F6F2] bg-[#D62839] px-6 py-3 font-bold text-[#F5F6F2] shadow-[3px_3px_0_#2874D0] transition-colors hover:bg-[#F4C430] hover:text-[#101214]">Save Changes</button>
                <a href="{{ route('moveset.index') }}" class="rounded-lg border border-[#3A424C] px-6 py-3 font-bold text-[#AEB6C1] transition-colors hover:border-[#F4C430] hover:text-[#F5F6F2]">Cancel</a>
            </div>
        </form>
    </div>
</x-layout>
