<nav>
    <div class="container">
        <div class="menu-toggle">
            <i class="bi bi-list" style="font-size: 40px; color: #b6b6b6;"> </i>
        </div>

        <a href="{{ route('home') }}" style="color: unset">
            <div class="brand">
                <img src="{{asset('images/brand.svg')}}">
            </div>
        </a>

        <div class="search-bar">
            <input type="text" v-model="search" placeholder="Pesquisar produtos" id="search-product" @keyup.enter="$router.push({ path: '/search', query: { q: search } })">
            <i class="bi bi-search search-product-icon" style="font-size: 28px; color: #b6b6b6;" @@click="$router.push({ path: '/search', query: { q: search } })"></i>
        </div>

        <div class="nav-user-container">

            @if (Route::has('login'))
            <div class="px-6 py-4 sm:block">
                @auth
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-gray-300 hover:text-gray-100 hover:border-gray-300 focus:outline-none focus:text-white  transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <ul>
                            <li>
                                Meu perfil
                            </li>

                        </ul>
                    </x-slot>
                </x-dropdown>
                @else
                <a href="{{ route('login') }}" class="actions-auth" >Log in</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="actions-auth">Register</a>
                @endif
                @endauth
            </div>
            @endif
        </div>


        <div class="actions-nav">
            <div class="cart-nav" @@click="$router.push({name: 'cart'})">
                <i class="bi bi-cart3" style="font-size: 30px; color: #0090F6;"></i>
            </div>

            <img src="{{asset('images/line.svg')}}" alt="">
            

            @auth
            <button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <i class="bi bi-box-arrow-right" style="font-size: 30px; color: #b2b2b2;" onclick="event.preventDefault();
                    this.closest('form').submit()"></i>

                </form>

            </button>
            @endauth

        </div>
    </div>





    <!-- Responsive Navigation Menu -->
    {{-- <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ ('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div> --}}

</nav>

