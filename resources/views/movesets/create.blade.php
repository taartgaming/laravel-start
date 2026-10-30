<x-layout title="Create Moveset">
    <!-- Form Container: centered, slightly lighter dark background, rounded with shadow -->
    <div class="mx-auto mt-12 max-w-2xl rounded-lg border border-[#3A424C] bg-[#181C21] p-8 shadow-[5px_5px_0_rgba(40,116,208,0.35)]">

        <h2 class="mb-8 text-center text-3xl font-extrabold tracking-wide text-[#F5F6F2]">Add New Moveset</h2>

        <form method="post" action="{{ route('moveset.store') }}" enctype="multipart/form-data" id="moveset-form"
              class="space-y-6">
            @csrf

            <div>
                <label for="method_id" class="mb-2 block text-sm font-medium text-[#F5F6F2]">Method</label>
                <select name="method_id" id="method_id"
                        class="w-full appearance-none rounded-lg border border-[#3A424C] bg-[#20262D] px-4 py-3 text-[#F5F6F2] transition-colors focus:border-[#F4C430] focus:outline-none focus:ring-1 focus:ring-[#F4C430]">
                    <option value="">-- Select a Method --</option>
                    @foreach($methods as $method)
                        <option value="{{ $method->id }}" {{ old('method_id') == $method->id ? 'selected' : '' }}>
                            {{ $method->description }}
                        </option>
                    @endforeach
                </select>
                @error('method_id')
                <p class="mt-1 text-sm text-[#D62839]">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="mb-2 block text-sm font-medium text-[#F5F6F2]">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="e.g. T-Perm"
                       class="w-full rounded-lg border border-[#3A424C] bg-[#20262D] px-4 py-3 text-[#F5F6F2] placeholder-[#AEB6C1] transition-colors focus:border-[#F4C430] focus:outline-none focus:ring-1 focus:ring-[#F4C430]">
                @error('name')
                <p class="mt-1 text-sm text-[#D62839]">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="num_moves" class="mb-2 block text-sm font-medium text-[#F5F6F2]">Number of Moves</label>
                    <input type="number" name="num_moves" id="num_moves" value="{{ old('num_moves') }}"
                           placeholder="e.g. 14"
                           class="w-full rounded-lg border border-[#3A424C] bg-[#20262D] px-4 py-3 text-[#F5F6F2] placeholder-[#AEB6C1] transition-colors focus:border-[#F4C430] focus:outline-none focus:ring-1 focus:ring-[#F4C430]">
                    @error('num_moves')
                    <p class="mt-1 text-sm text-[#D62839]">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="algorithm" class="mb-2 block text-sm font-medium text-[#F5F6F2]">Algorithm</label>
                    <input type="text" name="algorithm" id="algorithm" value="{{ old('algorithm') }}"
                           placeholder="R U R' U'..."
                           class="w-full rounded-lg border border-[#3A424C] bg-[#20262D] px-4 py-3 font-mono text-[#F5F6F2] placeholder-[#AEB6C1] transition-colors focus:border-[#F4C430] focus:outline-none focus:ring-1 focus:ring-[#F4C430]">
                    @error('algorithm')
                    <p class="mt-1 text-sm text-[#D62839]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="description" class="mb-2 block text-sm font-medium text-[#F5F6F2]">Description</label>
                <textarea name="description" id="description" rows="3" placeholder="Briefly describe this moveset..."
                          class="w-full resize-y rounded-lg border border-[#3A424C] bg-[#20262D] px-4 py-3 text-[#F5F6F2] placeholder-[#AEB6C1] transition-colors focus:border-[#F4C430] focus:outline-none focus:ring-1 focus:ring-[#F4C430]">{{ old('description') }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-[#D62839]">{{ $message }}</p>
                @enderror
            </div>
            <div class="pt-4">
                <button type="submit"
                        class="w-full cursor-pointer rounded-lg border-2 border-[#F5F6F2] bg-[#D62839] px-4 py-4 text-lg font-bold text-[#F5F6F2] shadow-[3px_3px_0_#2874D0] transition-all duration-300 hover:-translate-y-1 hover:bg-[#F4C430] hover:text-[#101214] hover:shadow-[3px_3px_0_#EF8B2C]">
                    Submit Moveset
                </button>
            </div>

        </form>
    </div>
</x-layout>
