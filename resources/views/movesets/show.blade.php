<x-layout title="{{ $moveset->name }}">
    <main class="max-w-4xl mx-auto p-6">

        {{-- Back Button --}}
        <a href="{{ route('moveset.index') }}"
           class="inline-block px-4 py-2 mb-8 bg-white text-[#1C1C1C] border-2 border-[#1C1C1C] rounded font-bold shadow-[4px_4px_0px_#1C1C1C] hover:bg-[#FFD500] transition-colors">
            &larr; Back to movesets
        </a>

        {{-- Main Content Card --}}
        <div class="bg-white border-4 border-[#1C1C1C] rounded-xl p-6 md:p-10 shadow-[8px_8px_0px_#1C1C1C]">

            {{-- Header Section --}}
            <div class="border-b-4 border-[#1C1C1C] pb-6 mb-8">
                <h1 class="text-4xl md:text-5xl font-black text-[#0045AD] mb-4 tracking-tight">
                    {{ $moveset->name }}
                </h1>
                <p class="text-xl text-[#1C1C1C] font-medium leading-relaxed">
                    {{ $moveset->description }}
                </p>
            </div>

            {{-- Stats/Tags Section --}}
            <div class="flex flex-wrap gap-4 mb-8">
                <div
                    class="bg-[#009B48] text-white border-2 border-[#1C1C1C] px-4 py-2 rounded font-bold shadow-[2px_2px_0px_#1C1C1C]">
                    Moves: {{ $moveset->num_moves }}
                </div>
            </div>

            {{-- Algorithm Display --}}
            <div class="bg-gray-50 border-2 border-[#1C1C1C] rounded-lg p-6 mb-10 text-center relative overflow-hidden">
                <span class="absolute top-0 left-0 bg-[#1C1C1C] text-white text-xs font-bold px-3 py-1 rounded-br-lg">
                    ALGORITHM
                </span>
                <p class="text-2xl md:text-3xl font-mono font-bold text-[#B71234] mt-4">
                    {{ $moveset->algorithm }}
                </p>
            </div>

            {{-- Twisty Player & Controls --}}
            <div
                class="flex flex-col items-center justify-center p-6 bg-white border-2 border-[#1C1C1C] rounded-xl border-dashed">

                <twisty-player
                    class="w-full max-w-sm mx-auto"
                    puzzle="3x3x3"
                    alg="{{ $moveset->algorithm }}"
                    hint-facelets="none"
                    background="none"
                    tempo-scale="20"
                    id="player"
                ></twisty-player>

                <button id="play-btn"
                        class="mt-8 px-8 py-3 bg-[#B71234] text-white border-2 border-[#1C1C1C] rounded font-bold text-xl shadow-[4px_4px_0px_#1C1C1C] hover:bg-[#FFD500] hover:text-[#1C1C1C] transition-colors w-full max-w-xs">
                    Play Animation
                </button>

            </div>

        </div>
    </main>
</x-layout>
