<x-layout title="moveset">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        @foreach($movesets as $moveset)

            <div class="bg-[#B71234] rounded-xl p-6 shadow-bg-[#B71234]/50 hover:bg-[#FFD500]">
                <h2 class="text-xl font-bold mb-4 ">{{$moveset->name}}</h2>
                <img src="{{asset('storage/' . $moveset->image)}}" alt="{{$moveset->name}}">
                <twisty-player
                    puzzle="3x3x3"
                    alg="R U R' U'"
                    hint-facelets="none"
                    background="none"
                    control-panel="none"
                >
                </twisty-player>
                @foreach($moveset->toArray() as $column => $value)
                    @if(!in_array($column, ['id', 'name', 'image']))
                        <p class="grid grid-cols-2 gap-2 mb-2 ">
                            <strong>{{ ucfirst(str_replace('_', ' ', $column)) }}:</strong>
                            <span>{{ $value }}</span>
                        </p>
                    @endif
                @endforeach
            </div>
        @endforeach

    </div>

    <h2 class="mt-8">hiihi</h2>
</x-layout>
