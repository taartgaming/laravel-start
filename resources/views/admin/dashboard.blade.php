<x-layout title="admin-dashboard">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">Admin Control Panel</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Select a module to manage database records.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Solves Card -->
            <a href="{{ route('admin.solves.index') }}"
               class="group block p-8 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md hover:ring-2 hover:ring-blue-500 transition-all duration-200">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-lg">
                        <!-- SVG Icon for Timer/Time -->
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        Manage Solves
                    </h2>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    Review user submitted timer records, edit timestamps, update scrambles, and approve or reject times
                    for the leaderboard.
                </p>
            </a>

            <!-- Movesets Card -->
            <a href="{{ route('admin.movesets.index') }}"
               class="group block p-8 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md hover:ring-2 hover:ring-purple-500 transition-all duration-200">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 rounded-lg">
                        <!-- SVG Icon for Cube/Database -->
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                        Manage Movesets
                    </h2>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    Control the dictionary of algorithms. Toggle the active status of specific moves via POST request to
                    hide or show them to regular users.
                </p>
            </a>

        </div>
    </div>
</x-layout>
