<x-layout title="moveset">

    <div class="mx-auto max-w-[2200px] px-4 py-8 sm:px-6 lg:px-8">
    <form method="GET" action="{{ route('moveset.index') }}" class="mb-8 space-y-4">
        <div class="flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search movesets..."
                class="min-w-0 flex-1 rounded border border-[#3A424C] bg-[#181C21] px-4 py-3 text-[#F5F6F2] outline-none focus:border-[#2874D0] focus:ring-2 focus:ring-[#2874D0]"
            >
            <button type="submit"
                    class="rounded border-2 border-[#F5F6F2] bg-[#D62839] px-6 py-3 font-bold text-[#F5F6F2] shadow-[3px_3px_0_#2874D0] transition-colors hover:bg-[#F4C430] hover:text-[#101214]">
                Search
            </button>
        </div>

        <div class="flex flex-wrap gap-2 ">

            <a href="{{ route('moveset.index', request()->except('method')) }}"
               draggable="false"
                    class="rounded-full border border-[#3A424C] bg-[#181C21] px-4 py-2 font-bold text-[#F5F6F2] transition-colors
                        {{ request('method') ? 'hover:border-[#F4C430]' : 'border-[#F4C430] text-[#F4C430]' }}">
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
                    <span class="block rounded-full border border-[#3A424C] bg-[#181C21] px-4 py-2 font-bold text-[#F5F6F2] transition-colors
                             hover:border-[#F4C430] peer-checked:border-[#2874D0] peer-checked:bg-[#2874D0]">
                    {{ $method->description }}
                </span>
                </label>
            @endforeach
        </div>
    </form>

    @if(session('status'))
        <div class="mb-8 rounded-lg border border-[#2874D0] bg-[#2874D0]/15 p-4 text-[#F5F6F2]">
            {{ session('status') }}
        </div>
    @endif

    @auth
        @can('create-moveset')
            <div
                class="mb-8 rounded border-2 border-[#F5F6F2] bg-[#D62839] px-6 py-3 text-center font-bold text-[#F5F6F2] shadow-[3px_3px_0_#2874D0] transition-colors hover:bg-[#F4C430] hover:text-[#101214]">
                <x-link href="{{ route('moveset.create')}}">create moveset</x-link>
            </div>
        @endcan
    @endauth


    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">

        @foreach($movesets as $moveset)
                    <div class="rounded-lg border border-[#3A424C] bg-[#181C21] p-6 shadow-[5px_5px_0_rgba(40,116,208,0.35)] transition-colors hover:border-[#F4C430] hover:shadow-[5px_5px_0_#EF8B2C]">
                        <x-link href="{{ route('moveset.show', $moveset) }}" draggable="false" class="block">
                        <h2 class="mb-4 text-xl font-bold text-[#F5F6F2]">{{$moveset->name}}</h2>

                        <twisty-player
                            class = "select-none"
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
                            @if(!in_array($column, ['id', 'name', 'algorithm', 'user_id', 'user', 'method', 'method_id', 'created_at', 'updated_at', 'is_active']))
                                <p class="grid grid-cols-2 gap-2 mb-2 text-[#AEB6C1]">
                                    <strong>{{ ucfirst(str_replace('_', ' ', $column)) }}:</strong>
                                    <span>{{ is_array($value) ? json_encode($value) : $value }}</span>
                                </p>
                            @endif

                        @endforeach
    
                        <p class="grid grid-cols-2 gap-2 mb-2 text-shadow-black">
                            <strong class="text-xl text-[#F5F6F2]">Made By:</strong>
                            <span>{{ $moveset->user->name ?? 'System' }}</span>
                        </p>
                        </x-link>

                    </div>

        @endforeach

    </div>

    @if($movesets->hasPages())
        <nav class="mt-10 flex justify-center" aria-label="Moveset pagination">
            {{ $movesets->links() }}
        </nav>
    @endif
    </div>


</x-layout>
