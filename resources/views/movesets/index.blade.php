<x-layout title="moveset">

    <form method="GET" action="{{ route('moveset.index') }}" class=" mb-6 space-y-4">
        <div class="flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search movesets..."
                class="flex-1 border-2 border-[#1C1C1C] rounded px-4 py-2 shadow-[4px_4px_0px_#1C1C1C]"
            >
            <button type="submit"
                    class="bg-[#B71234] border-2 border-[#1C1C1C] rounded px-6 py-2 text-white font-bold hover:bg-[#FFD500] hover:text-[#1C1C1C] transition-colors shadow-[4px_4px_0px_#1C1C1C]">
                Search
            </button>
        </div>

        <div class="flex flex-wrap gap-2 ">

            <a href="{{ route('moveset.index', request()->except('method')) }}"
               draggable="false"
               class="px-4 py-1 rounded-full border-2 border-[#1C1C1C] font-bold transition-colors
                  {{ request('method') ? 'bg-white text-[#1C1C1C] hover:bg-[#FFD500]' : 'bg-[#1C1C1C] text-white' }}">
                All
            </a>

            @foreach($methods as $method)
                <label class="cursor-pointer">
                    <input
                        type="checkbox"
                        name="methods[]"
                        value="{{ $method->id }}"
                        class="peer sr-only"
                        onchange="this.form.submit()"
                        @checked(in_array($method->id, (array) request('methods', [])))
                    >
                    <span class="block px-4 py-1 rounded-full border-2 border-[#1C1C1C] font-bold bg-white text-[#1C1C1C] transition-colors
                             hover:bg-[#FFD500]
                             peer-checked:bg-[#1C1C1C] peer-checked:text-white">
                    {{ $method->description }}
                </span>
                </label>
            @endforeach
        </div>
    </form>
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
            @if($moveset->is_active)
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
                            tempo-scale="2"
                            id="player"
                        >


                        </twisty-player>

                        @foreach($moveset->toArray() as $column => $value)
                            @if(!in_array($column, ['id', 'name', 'algorithm', 'user_id','method', 'method_id', 'created_at', 'updated_at']))
                                <p class="grid grid-cols-2 gap-2 mb-2 text-shadow-black">
                                    <strong>{{ ucfirst(str_replace('_', ' ', $column)) }}:</strong>
                                    <span>{{ $value }}</span>
                                </p>
                            @endif

                        @endforeach
                        <p class="grid grid-cols-2 gap-2 mb-2 text-shadow-black">
                            <strong class="text-xl">Made By:</strong>
                            <span>{{ $moveset->user->name ?? 'System' }}</span>
                        </p>
                    </div>
                </x-link>
            @endif

        @endforeach

    </div>


</x-layout>
