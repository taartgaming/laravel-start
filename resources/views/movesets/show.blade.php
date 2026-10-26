<x-layout title="{{ $moveset->name }}">
    <main class="max-w-4xl mx-auto p-6">
        <a href="{{ route('moveset.index') }}" class="underline">
            Back to movesets
        </a>

        <h1 class="text-4xl font-bold mt-6">
            {{ $moveset->name }}
        </h1>

        <p class="mt-4">
            {{ $moveset->description }}
        </p>

        <p class="mt-4">
            <strong>Number of moves:</strong>
            {{ $moveset->num_moves }}
        </p>

        <p class="mt-4">
            <strong>Algorithm:</strong>
            {{ $moveset->algorithm }}
        </p>

        <twisty-player
            class="mt-8"
            puzzle="3x3x3"
            alg="{{ $moveset->algorithm }}"
            hint-facelets="none"
            background="none"
        >
        </twisty-player>
    </main>
</x-layout>
