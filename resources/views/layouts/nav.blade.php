<nav class="text-xl p-6 bg-white border-b-4 border-[#1C1C1C] sticky top-0">
    <div class="flex flex-row gap-10 justify-between items-center">


        <div class="flex gap-6 text-[#0045AD] font-bold">
            <x-link class="hover:text-[#FFD500] transition-colors" href="{{ route('contact')}}"
                    :active="request()->routeIs('contact')">contact
            </x-link>
            <x-link class="hover:text-[#FFD500] transition-colors" href="{{ route('about') }}"
                    :active="request()->routeIs('about')">about us
            </x-link>
            <x-link class="hover:text-[#FFD500] transition-colors" href="{{ route('home') }}"
                    :active="request()->routeIs('home')">Home
            </x-link>
            <x-link class="hover:text-[#FFD500] transition-colors" href="{{ route('moveset.index') }}"
                    :active="request()->routeIs('moveset.index', 'moveset.show')">
                moveset
            </x-link>
        </div>
        <div class="flex gap-6">

            <div
                class="bg-[#B71234] border-2 border-[#1C1C1C] rounded px-6 py-2 text-white hover:bg-[#FFD500] hover:text-[#1C1C1C] font-bold transition-colors shadow-[4px_4px_0px_#1C1C1C]">
                <x-link href="{{ route('login')}}">login</x-link>
            </div>

            @auth
                @if(!auth()->user())
                    <div
                        class="bg-[#B71234] border-2 border-[#1C1C1C] rounded px-6 py-2 text-white hover:bg-[#FFD500] hover:text-[#1C1C1C] font-bold transition-colors shadow-[4px_4px_0px_#1C1C1C]">
                        <x-link href="{{ route('register')}}">register</x-link>
                    </div>
                @endif
            @endauth


        </div>


    </div>
</nav>
