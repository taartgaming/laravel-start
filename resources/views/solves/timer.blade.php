<x-layout title="timer">

    <div class="min-h-[calc(100vh-5rem)] w-full bg-[#101214] px-4 py-10 text-[#F5F6F2] sm:px-6 lg:px-8">

        <div class="mx-auto grid max-w-[2200px] items-start gap-10 xl:grid-cols-[minmax(0,1fr)_32rem]">
            <section class="flex min-h-[calc(100vh-10rem)] flex-col items-center justify-center text-center">
            
            <div class="mb-16">
                <h2 class="mb-4 text-sm uppercase tracking-widest text-[#AEB6C1]">Scramble</h2>
                <p id="scramble-display"
                   class="min-h-[6rem] text-4xl font-bold leading-relaxed tracking-widest text-[#F4C430] drop-shadow-md md:text-5xl">
                    Loading scramble...
                </p>
            </div>

            <div class="mb-12">
                <h1 id="timer-display"
                    class="text-9xl font-mono font-bold transition-colors duration-200 md:text-[12rem]">
                    0.00
                </h1>
                <p class="mt-6 text-lg tracking-wide text-[#AEB6C1]">
                    Hold <kbd class="rounded-md border border-[#3A424C] bg-[#20262D] px-3 py-1 text-[#F5F6F2]">Space</kbd>
                    to start, press any key to stop.
                </p>
            </div>

            <div id="action-area" class="flex h-20 items-center justify-center">
                <button id="save-btn"
                        class="hidden rounded-lg border-2 border-[#F5F6F2] bg-[#D62839] px-12 py-4 text-xl font-bold text-[#F5F6F2] shadow-[4px_4px_0_#2874D0] transition-all hover:bg-[#F4C430] hover:text-[#101214] hover:shadow-[4px_4px_0_#EF8B2C]">
                    Save Time
                </button>
                <p id="save-status" class="hidden text-2xl font-semibold text-[#2874D0]"></p>
            </div>

            </section>

            <aside class="rounded-lg border border-[#3A424C] bg-[#181C21] p-8 shadow-[5px_5px_0_rgba(40,116,208,0.35)]">
                <div class="mb-6 flex items-end justify-between gap-4 border-b border-[#3A424C] pb-5">
                    <div>
                        <p class="text-sm uppercase tracking-[0.2em] text-[#AEB6C1]">Accepted solves</p>
                        <h2 class="mt-1 text-3xl font-black text-[#F5F6F2]">Leaderboard</h2>
                    </div>
                    <span class="text-4xl font-black text-[#F4C430]">#</span>
                </div>

                @forelse($leaderboard as $position => $solve)
                    <div class="flex items-center gap-4 border-b border-[#3A424C] py-5 last:border-b-0">
                        <span class="w-9 text-2xl font-black {{ $position === 0 ? 'text-[#F4C430]' : ($position === 1 ? 'text-[#AEB6C1]' : ($position === 2 ? 'text-[#EF8B2C]' : 'text-[#3A424C]')) }}">
                            {{ $position + 1 }}
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-lg font-semibold text-[#F5F6F2]">{{ $solve->user->name ?? 'Unknown solver' }}</p>
                            <p class="font-mono text-sm text-[#AEB6C1]">{{ number_format($solve->time_ms / 1000, 2) }} seconds</p>
                        </div>
                        <span class="font-mono text-2xl font-bold text-[#2874D0]">{{ number_format($solve->time_ms / 1000, 2) }}s</span>
                    </div>
                @empty
                    <p class="py-8 text-center text-[#AEB6C1]">No accepted solves yet.</p>
                @endforelse
            </aside>

        </div>

    </div>


</x-layout>
