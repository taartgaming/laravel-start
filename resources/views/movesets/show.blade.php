<x-layout title="{{ $moveset->name }}">
    <main class="max-w-4xl mx-auto p-6">

        {{-- Back Button --}}
        <a href="{{ route('moveset.index') }}"
           class="mb-8 inline-block rounded border-2 border-[#F5F6F2] bg-[#181C21] px-4 py-2 font-bold text-[#F5F6F2] shadow-[3px_3px_0_#2874D0] transition-colors hover:bg-[#F4C430] hover:text-[#101214]">
            &larr; Back to movesets
        </a>

        {{-- Main Content Card --}}
        <div
            class="rounded-lg border border-[#3A424C] bg-[#181C21] p-6 shadow-[5px_5px_0_rgba(40,116,208,0.35)] md:p-10">

            {{-- Header Section --}}
            <div class="mb-8 border-b border-[#3A424C] pb-6">
                <h1 class="mb-4 text-4xl font-black tracking-tight text-[#2874D0] md:text-5xl">
                    {{ $moveset->name }}
                </h1>
                <p class="text-xl font-medium leading-relaxed text-[#AEB6C1]">
                    {{ $moveset->description }}
                </p>
            </div>

            {{-- Stats/Tags Section --}}
            <div class="flex flex-wrap gap-4 mb-8">
                <div
                    class="rounded border border-[#2874D0] bg-[#2874D0] px-4 py-2 font-bold text-[#F5F6F2] shadow-[2px_2px_0_#101214]">
                    Moves: {{ $moveset->num_moves }}
                </div>
            </div>

            {{-- Algorithm Display --}}
            <div class="relative mb-10 overflow-hidden rounded-lg border border-[#3A424C] bg-[#20262D] p-6 text-center">
                <span
                    class="absolute left-0 top-0 rounded-br-lg bg-[#101214] px-3 py-1 text-xs font-bold text-[#F5F6F2]">
                    ALGORITHM
                </span>
                <p class="mt-4 font-mono text-2xl font-bold text-[#D62839] md:text-3xl">
                    {{ $moveset->algorithm }}
                </p>
            </div>

            {{-- Twisty Player & Controls --}}
            <div
                class="flex flex-col items-center justify-center rounded-lg border border-dashed border-[#3A424C] bg-[#101214] p-6">

                <twisty-player
                    class=" mx-auto w-full max-w-sm select-none"
                    puzzle="3x3x3"
                    alg="{{ $moveset->algorithm }}"
                    hint-facelets="none"
                    background="none"
                    tempo-scale="2"
                    id="player"
                ></twisty-player>


            </div>

        </div>
    </main>
</x-layout>
