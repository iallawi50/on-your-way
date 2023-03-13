<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-row-reverse sm:flex-row justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:mr-5 sm:flex">
                    <x-nav-link href="{{ route('orders.index') }}" class="ml-4" :active="request()->routeIs('orders.index')">
                        {{ __('الرئيسية') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:mr-5 sm:flex">
                    <x-nav-link href="{{ route('invites') }}" class="ml-4 relative" :active="request()->routeIs('invites')">
                        <div>
                            {{ __('الدعوات') }}

                            <span
                                class="check-counter-invites-1 bg-red-500 absolute  w-5 h-5 rounded-full flex justify-center items-center text-white top-1 sm:left-1">@livewire('invite-notification', ['user_id' => auth()->user()->id], key(auth()->user()->id))</span>

                        </div>
                    </x-nav-link>
                </div>
                @if (auth()->user() != null && auth()->user()->admin)
                    <div class="hidden space-x-8 sm:-my-px sm:mr-5 sm:flex">
                        <x-nav-link href="{{ route('admin-dashboard') }}" class="ml-4" :active="request()->routeIs('admin-dashboard')">
                            {{ __('لوحة التحكم') }}
                        </x-nav-link>
                    </div>
                @endif
            </div>

            <div class="hidden sm:flex sm:items-center sm:mr-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="mr-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-200"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="mr-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="mr-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            {{-- <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div> --}}

                            {{-- <div class="border-t border-gray-200"></div> --}}


                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('الملف الشخصي') }}
                            </x-dropdown-link>




                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif



                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('تسجيل خروج') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">

                <button @click="open = ! open"
                    class="inline-flex relative items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span
                        class="check-counter-invites-2 bg-red-500 absolute  w-5 h-5 rounded-full flex justify-center items-center text-white top-0 left-1">@livewire('invite-notification', ['user_id' => auth()->user()->id], key(auth()->user()->id))</span>

                </button>

            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('orders.index') }}" :active="request()->routeIs('orders.index')">
                {{ __('الرئيسية') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link class="relative" href="{{ route('invites') }}" :active="request()->routeIs('invites')">
                {{ __('الدعوات') }}
                <span
                    class="check-counter-invites-3 bg-red-500 absolute  w-5 h-5 rounded-full flex justify-center items-center text-white top-1.5 left-1 ml-5">
                    @livewire('invite-notification', ['user_id' => auth()->user()->id], key(auth()->user()->id))

                </span>
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('admin-dashboard') }}" :active="request()->routeIs('admin-dashboard')">
                {{ __('لوحة التحكم') }}
            </x-responsive-nav-link>

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif
                {{--
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div> --}}
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('الملف الشخصي') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('تسجيل خروج') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-switchable-team :team="$team" component="responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <audio src="{{ asset('notification.mp3') }}"></audio>
</nav>
<script>
    document.querySelector(".check-counter-invites-1").classList.add('hidden')
    document.querySelector(".check-counter-invites-2").classList.add('hidden')
    document.querySelector(".check-counter-invites-3").classList.add('hidden')
    // sessionStorage.setItem('count', +document.querySelector(".check-counter-invites-1").textContent)
    // var count = sessionStorage.getItem("count");
    var check = setInterval(() => {
        if (+document.querySelector(".check-counter-invites-1").textContent == "0") {
            document.querySelector(".check-counter-invites-1").classList.add('hidden')
            document.querySelector(".check-counter-invites-2").classList.add('hidden')
            document.querySelector(".check-counter-invites-3").classList.add('hidden')
        } else {
            document.querySelector(".check-counter-invites-1").classList.remove('hidden')
            document.querySelector(".check-counter-invites-2").classList.remove('hidden')
            document.querySelector(".check-counter-invites-3").classList.remove('hidden')
            count = +document.querySelector(".check-counter-invites-1").textContent
            document.querySelector("audio").play();
            clearInterval(check);
        }
    }, 1000);

    // setInterval(() => {
    //     if (+document.querySelector(".check-counter-invites-1").textContent != count) {
    //         document.querySelector("audio").play();
    //         count = sessionStorage.setItem("count", +document.querySelector(".check-counter-invites-1").textContent)
    //          console.log(count)
    //     }
    // }, 1000);
</script>
