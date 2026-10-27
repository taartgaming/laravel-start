<nav class="text-xl p-6 bg-white border-b-4 border-[#1C1C1C] sticky top-0">
    <div class="flex flex-row gap-10 justify-between items-center">
        <div class="flex gap-6 text-[#1C1C1C] font-bold">
            <x-link class="hover:text-[#1C1C1C] transition-colors" href="{{ route('home') }}"
                    :active="request()->routeIs('home')">
                <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0oqda_O2TzcKlOR1Nit_c5bJAN8W4DglMmz_EsLSjIA&s=10"
                    class="h-10 w-auto object-contain"
                    alt="Home Logo">
            </x-link>
            <x-link class="hover:text-[#1C1C1C] transition-colors" href="{{ route('contact')}}"
                    :active="request()->routeIs('contact')">contact
            </x-link>
            <x-link class="hover:text-[#1C1C1C] transition-colors" href="{{ route('about') }}"
                    :active="request()->routeIs('about')">about us
            </x-link>

            <x-link class="hover:text-[#1C1C1C] transition-colors" href="{{ route('moveset.index') }}"
                    :active="request()->routeIs('moveset.index', 'moveset.show')">
                moveset
            </x-link>
            <x-link class="hover:text-[#1C1C1C] transition-colors" href="{{ route('timer') }}"
                    :active="request()->routeIs('timer')">
                Timed run
            </x-link>
        </div>
        <div class="flex gap-6">

            <div
                class="bg-[#B71234] border-2 border-[#1C1C1C] rounded px-6 py-2 text-white hover:bg-[#FFD500] hover:text-[#1C1C1C] font-bold transition-colors shadow-[4px_4px_0px_#1C1C1C]">
                <x-link href="{{ route('login')}}">login</x-link>
            </div>


            <div
                class="bg-[#B71234] border-2 border-[#1C1C1C] rounded px-6 py-2 text-white hover:bg-[#FFD500] hover:text-[#1C1C1C] font-bold transition-colors shadow-[4px_4px_0px_#1C1C1C]">
                <x-link href="{{ route('register')}}">register</x-link>
            </div>


        </div>


    </div>
</nav>
