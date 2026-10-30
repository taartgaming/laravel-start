<x-layout title="admin-moveset">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-200">Admin: Manage Movesets</h2>

        @if (session('status'))
            <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b bg-gray-50 dark:bg-gray-700/50 dark:border-gray-700 dark:text-gray-200">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Algorithm</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y dark:divide-gray-700 text-gray-900 dark:text-gray-100">
                @foreach ($movesets as $moveset)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-4 py-3">{{ $moveset->user->name ?? 'System' }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $moveset->name }}</td>
                        <td class="px-4 py-3 font-mono text-xs text-gray-500">{{ $moveset->algorithm }}</td>

                        <!-- Status Badge -->
                        <td class="px-4 py-3">
                            @if($moveset->is_active)
                                <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Actief</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">Niet actief</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-right flex justify-end gap-2">

                            <form action="{{ route('admin.movesets.toggle', $moveset) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="px-3 py-1 rounded {{ $moveset->is_active ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600' }} text-white text-xs font-bold transition-colors">
                                    {{ $moveset->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>


                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
