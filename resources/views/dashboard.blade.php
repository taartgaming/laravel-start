<x-layout title="dashboard">
    @php
        $activeTab = in_array($tab, ['overview', 'admin', 'account'], true) ? $tab : 'overview';
    @endphp

    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-[#F4C430]">Account dashboard</p>
                <h1 class="mt-2 text-4xl font-extrabold text-[#F5F6F2]">Welcome, {{ $user->name }}</h1>
            </div>
            <p class="text-sm text-[#AEB6C1]">{{ $user->email }}</p>
        </div>

        <div class="mb-8 flex flex-wrap gap-2 border-b border-[#3A424C] pb-3">
            <a href="{{ route('dashboard', ['tab' => 'overview']) }}"
               class="rounded px-4 py-2 font-bold transition-colors {{ $activeTab === 'overview' ? 'bg-[#2874D0] text-[#F5F6F2]' : 'text-[#AEB6C1] hover:bg-[#20262D] hover:text-[#F5F6F2]' }}">Overview</a>
            @can('access-admin')
                <a href="{{ route('dashboard', ['tab' => 'admin']) }}"
                   class="rounded px-4 py-2 font-bold transition-colors {{ $activeTab === 'admin' ? 'bg-[#D62839] text-[#F5F6F2]' : 'text-[#AEB6C1] hover:bg-[#20262D] hover:text-[#F5F6F2]' }}">Admin</a>
            @endcan
            @can('access-creator')
                <a href="{{ route('admin.movesets.index') }}"
                   class="rounded px-4 py-2 font-bold transition-colors {{ $activeTab === 'admin' ? 'bg-[#D62839] text-[#F5F6F2]' : 'text-[#AEB6C1] hover:bg-[#20262D] hover:text-[#F5F6F2]' }}">
                    Manage Movesets
                </a>
            @endcan
            <a href="{{ route('dashboard', ['tab' => 'account']) }}"
               class="rounded px-4 py-2 font-bold transition-colors {{ $activeTab === 'account' ? 'bg-[#F4C430] text-[#101214]' : 'text-[#AEB6C1] hover:bg-[#20262D] hover:text-[#F5F6F2]' }}">Account</a>
        </div>

        @if (session('status'))
            <div
                class="mb-6 rounded border border-[#2874D0] bg-[#2874D0]/15 p-4 text-[#F5F6F2]">{{ session('status') === 'verification-link-sent' ? 'A new verification link has been sent to your email address.' : session('status') }}</div>
        @endif

        @if ($activeTab === 'overview')
            <div class="grid gap-6 md:grid-cols-3">
                <div
                    class="rounded-lg border border-[#3A424C] bg-[#181C21] p-6 shadow-[5px_5px_0_rgba(40,116,208,0.35)]">
                    <p class="text-sm text-[#AEB6C1]">Role</p>
                    <p class="mt-2 text-2xl font-bold capitalize text-[#F5F6F2]">{{ $user->role }}</p></div>
                <div
                    class="rounded-lg border border-[#3A424C] bg-[#181C21] p-6 shadow-[5px_5px_0_rgba(239,139,44,0.35)]">
                    <p class="text-sm text-[#AEB6C1]">Accepted timed runs</p>
                    <p class="mt-2 text-2xl font-bold text-[#F5F6F2]">{{ $user->solves()->where('accepted', true)->count() }}</p>
                </div>
                <div
                    class="rounded-lg border border-[#3A424C] bg-[#181C21] p-6 shadow-[5px_5px_0_rgba(214,40,57,0.35)]">
                    <p class="text-sm text-[#AEB6C1]">Email status</p>
                    <p class="mt-2 text-2xl font-bold text-[#F5F6F2]">{{ $user->hasVerifiedEmail() ? 'Verified' : 'Unverified' }}</p>
                </div>
            </div>
        @elseif ($activeTab === 'admin')
            @can('access-admin')
                <div class="grid gap-6 md:grid-cols-2">
                    <a href="{{ route('admin.solves.index') }}"
                       class="rounded-lg border border-[#3A424C] bg-[#181C21] p-8 shadow-[5px_5px_0_rgba(40,116,208,0.35)] transition-colors hover:border-[#2874D0]">
                        <h2 class="text-2xl font-bold text-[#F5F6F2]">Manage Solves</h2>
                        <p class="mt-3 text-[#AEB6C1]">Review, edit, approve, reject, or remove submitted timed
                            runs.</p></a>
                    <a href="{{ route('admin.movesets.index') }}"
                       class="rounded-lg border border-[#3A424C] bg-[#181C21] p-8 shadow-[5px_5px_0_rgba(239,139,44,0.35)] transition-colors hover:border-[#EF8B2C]">
                        <h2 class="text-2xl font-bold text-[#F5F6F2]">Manage Movesets</h2>
                        <p class="mt-3 text-[#AEB6C1]">Edit movesets and control which algorithms are visible.</p></a>
                    <a href="{{ route('admin.users.index') }}"
                       class="rounded-lg border border-[#3A424C] bg-[#181C21] p-8 shadow-[5px_5px_0_rgba(214,40,57,0.35)] transition-colors hover:border-[#D62839]">
                        <h2 class="text-2xl font-bold text-[#F5F6F2]">Manage Users</h2>
                        <p class="mt-3 text-[#AEB6C1]">Review accounts, creator roles, accepted runs, and linked movesets.</p>
                    </a>
                </div>
            @endcan
        @else
            <div class="grid gap-6 lg:grid-cols-2">
                <section
                    class="rounded-lg border border-[#3A424C] bg-[#181C21] p-6 shadow-[5px_5px_0_rgba(40,116,208,0.35)]">
                    <h2 class="text-2xl font-bold text-[#F5F6F2]">Profile information</h2>
                    <p class="mt-2 text-sm text-[#AEB6C1]">Change your username and email address.</p>
                    <form method="post" action="{{ route('profile.update') }}"
                          class="mt-6 space-y-5">@csrf @method('patch')
                        <div><label for="name" class="block text-sm font-bold text-[#F5F6F2]">Username</label><input
                                id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                                class="mt-2 w-full rounded border border-[#3A424C] bg-[#20262D] px-4 py-3 text-[#F5F6F2] focus:border-[#F4C430] focus:outline-none">@error('name')
                            <p class="mt-1 text-sm text-[#D62839]">{{ $message }}</p>@enderror</div>
                        <div><label for="email" class="block text-sm font-bold text-[#F5F6F2]">Email</label><input
                                id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                                class="mt-2 w-full rounded border border-[#3A424C] bg-[#20262D] px-4 py-3 text-[#F5F6F2] focus:border-[#F4C430] focus:outline-none">@error('email')
                            <p class="mt-1 text-sm text-[#D62839]">{{ $message }}</p>@enderror</div>
                        <button
                            class="rounded border-2 border-[#F5F6F2] bg-[#D62839] px-5 py-3 font-bold text-[#F5F6F2] shadow-[3px_3px_0_#2874D0] hover:bg-[#F4C430] hover:text-[#101214]">
                            Save profile
                        </button>
                    </form>
                    <div class="mt-6 border-t border-[#3A424C] pt-5 text-sm">@if ($user->hasVerifiedEmail())
                            <p class="text-[#2874D0]">Email verified.</p>
                        @else
                            <p class="text-[#F4C430]">Email not verified.</p>
                            <form method="post" action="{{ route('verification.send') }}" class="mt-2">@csrf
                                <button class="font-bold text-[#F5F6F2] underline hover:text-[#F4C430]">Resend
                                    verification email
                                </button>
                            </form>
                        @endif</div>
                </section>
                <section
                    class="rounded-lg border border-[#3A424C] bg-[#181C21] p-6 shadow-[5px_5px_0_rgba(239,139,44,0.35)]">
                    <h2 class="text-2xl font-bold text-[#F5F6F2]">Change password</h2>
                    <p class="mt-2 text-sm text-[#AEB6C1]">Use a strong password that you do not reuse elsewhere.</p>
                    <form method="post" action="{{ route('password.update') }}"
                          class="mt-6 space-y-5">@csrf @method('put')
                        <div><label for="current_password" class="block text-sm font-bold text-[#F5F6F2]">Current
                                password</label><input id="current_password" name="current_password" type="password"
                                                       required
                                                       class="mt-2 w-full rounded border border-[#3A424C] bg-[#20262D] px-4 py-3 text-[#F5F6F2]">
                        </div>
                        <div><label for="password" class="block text-sm font-bold text-[#F5F6F2]">New
                                password</label><input id="password" name="password" type="password" required
                                                       class="mt-2 w-full rounded border border-[#3A424C] bg-[#20262D] px-4 py-3 text-[#F5F6F2]">
                        </div>
                        <div><label for="password_confirmation" class="block text-sm font-bold text-[#F5F6F2]">Confirm
                                new password</label><input id="password_confirmation" name="password_confirmation"
                                                           type="password" required
                                                           class="mt-2 w-full rounded border border-[#3A424C] bg-[#20262D] px-4 py-3 text-[#F5F6F2]">
                        </div>
                        <button
                            class="rounded border-2 border-[#F5F6F2] bg-[#2874D0] px-5 py-3 font-bold text-[#F5F6F2] shadow-[3px_3px_0_#D62839] hover:bg-[#F4C430] hover:text-[#101214]">
                            Update password
                        </button>
                    </form>
                </section>
            </div>
        @endif
    </div>
</x-layout>
