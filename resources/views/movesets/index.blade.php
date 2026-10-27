<x-layout title="moveset">

    <div class="flex flex-wrap gap-4 mb-8" id="filter-container">
        <button
            class="filter-btn px-6 py-2 bg-[#0045AD] text-white border-2 border-[#1C1C1C] rounded font-bold shadow-[4px_4px_0px_#1C1C1C] hover:bg-[#FFD500] hover:text-[#1C1C1C] transition-colors"
            data-filter="all">
            All Steps
        </button>

        {{-- Dynamic Method Buttons --}}
        @foreach($methods as $method)
            <button
                class="filter-btn px-6 py-2 bg-white text-[#1C1C1C] border-2 border-[#1C1C1C] rounded font-bold shadow-[4px_4px_0px_#1C1C1C] hover:bg-[#FFD500] transition-colors"
                data-filter="{{ $method->id }}">
                {{ $method->description }}
            </button>
        @endforeach
    </div>
    @auth
        @if(auth()->user()->canCreateMovesets())
            <div
                class="bg-[#B71234] border-2 border-[#1C1C1C] rounded px-6 py-2 text-center text-white hover:bg-[#FFD500] hover:text-[#1C1C1C] font-bold transition-colors shadow-[4px_4px_0px_#1C1C1C] text-shadow-black">
                <x-link href="{{ route('moveset.create')}}">create moveset</x-link>
            </div>
        @endif
    @endauth


    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        @foreach($movesets as $moveset)
            <x-link href="{{ route('moveset.show', $moveset) }}">
                <div class="bg-[#B71234] rounded-xl p-6 shadow-bg-[#B71234]/50 hover:bg-[#FFD500]">
                    <h2 class="text-xl font-bold mb-4 ">{{$moveset->name}}</h2>

                    <twisty-player
                        puzzle="3x3x3"
                        experimental-setup-anchor="end"
                        alg="{{$moveset->algorithm}}"
                        hint-facelets="none"
                        background="none"
                        control-panel="none"
                    >


                    </twisty-player>
                    @foreach($moveset->toArray() as $column => $value)
                        @if(!in_array($column, ['id', 'name', 'image', 'algorithm']))
                            <p class="grid grid-cols-2 gap-2 mb-2 text-shadow-black">
                                <strong>{{ ucfirst(str_replace('_', ' ', $column)) }}:</strong>
                                <span>{{ $value }}</span>
                            </p>
                        @endif
                    @endforeach
                </div>
            </x-link>
        @endforeach

    </div>


</x-layout>
