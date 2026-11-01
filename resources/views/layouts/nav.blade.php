<nav class="bg-[#181C21] text-lg p-4 sm:p-6 border-b-4 border-[#2874D0] sticky top-0 z-10">
    <div class="flex flex-row gap-10 justify-between items-center">
        <div class="flex flex-wrap gap-x-6 gap-y-3 text-[#AEB6C1] font-bold">
            <x-link class="transition-colors" href="{{ route('home') }}"
                    :active="request()->routeIs('home')">
                <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0oqda_O2TzcKlOR1Nit_c5bJAN8W4DglMmz_EsLSjIA&s=10"
                    class="h-10 w-auto object-contain"
                    alt="Home Logo">
            </x-link>
            <x-link class="transition-colors" href="{{ route('contact')}}"
                    :active="request()->routeIs('contact')">contact
            </x-link>
            <x-link class="transition-colors" href="{{ route('about') }}"
                    :active="request()->routeIs('about')">about us
            </x-link>

            <x-link class="transition-colors" href="{{ route('moveset.index') }}"
                    :active="request()->routeIs('moveset.index', 'moveset.show')">
                moveset
            </x-link>
            <x-link class="transition-colors" href="{{ route('timer') }}"
                    :active="request()->routeIs('timer')">
                Timed run
            </x-link>
        </div>
        <div class="flex gap-6">
            @guest
                <div class="rounded border-2 border-[#F5F6F2] bg-[#D62839] px-4 py-2 font-bold text-[#F5F6F2] shadow-[3px_3px_0_#2874D0] transition-colors hover:bg-[#F4C430] hover:text-[#101214]"><x-link href="{{ route('login') }}">login</x-link></div>
                <div class="rounded border-2 border-[#F5F6F2] bg-[#D62839] px-4 py-2 font-bold text-[#F5F6F2] shadow-[3px_3px_0_#2874D0] transition-colors hover:bg-[#F4C430] hover:text-[#101214]"><x-link href="{{ route('register') }}">register</x-link></div>
            @else
                <x-link
                    href="{{ route('dashboard') }}"
                    :active="request()->routeIs('dashboard', 'profile.edit')"
                    class="rounded border-2 border-[#F5F6F2] bg-[#2874D0] px-4 py-2 font-bold text-[#F5F6F2] shadow-[3px_3px_0_#D62839] transition-colors hover:bg-[#F4C430] hover:text-[#101214]"
                >
                    {{ auth()->user()->name }}
                </x-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="rounded border-2 border-[#F5F6F2] bg-[#D62839] px-4 py-2 font-bold text-[#F5F6F2] shadow-[3px_3px_0_#2874D0] transition-colors hover:bg-[#F4C430] hover:text-[#101214]"
                    >
                        logout
                    </button>
                </form>
            @endguest
        </div>
    </div>
</nav>
