<x-layout title="admin-dashboard">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-[#F5F6F2]">Admin Control Panel</h1>
            <p class="mt-2 text-sm text-[#AEB6C1]">Select a module to manage database records.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Solves Card -->
            <a href="{{ route('admin.solves.index') }}"
               class="group block rounded-lg border border-[#3A424C] bg-[#181C21] p-8 shadow-[5px_5px_0_rgba(40,116,208,0.35)] transition-all duration-200 hover:border-[#2874D0] hover:shadow-[5px_5px_0_#2874D0]">
                <div class="flex items-center gap-4 mb-4">
                    <div class="rounded-lg border border-[#2874D0] bg-[#2874D0]/15 p-3 text-[#2874D0]">
                        <!-- SVG Icon for Timer/Time -->
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-[#F5F6F2] transition-colors group-hover:text-[#2874D0]">
                        Manage Solves
                    </h2>
                </div>
                <p class="text-[#AEB6C1]">
                    Review user submitted timer records, edit timestamps, update scrambles, and approve or reject times
                    for the leaderboard.
                </p>
            </a>

            <!-- Movesets Card -->
            <a href="{{ route('admin.movesets.index') }}"
               class="group block rounded-lg border border-[#3A424C] bg-[#181C21] p-8 shadow-[5px_5px_0_rgba(239,139,44,0.35)] transition-all duration-200 hover:border-[#EF8B2C] hover:shadow-[5px_5px_0_#EF8B2C]">
                <div class="flex items-center gap-4 mb-4">
                    <div class="rounded-lg border border-[#EF8B2C] bg-[#EF8B2C]/15 p-3 text-[#EF8B2C]">
                        <!-- SVG Icon for Cube/Database -->
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-[#F5F6F2] transition-colors group-hover:text-[#EF8B2C]">
                        Manage Movesets
                    </h2>
                </div>
                <p class="text-[#AEB6C1]">
                    Control the dictionary of algorithms. Toggle the active status of specific moves via POST request to
                    hide or show them to regular users.
                </p>
            </a>

        </div>
    </div>
</x-layout>
