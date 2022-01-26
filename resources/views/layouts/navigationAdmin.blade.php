<nav x-data="{ open: false }" class="nav-admin">
    <!-- Primary Navigation Menu -->


    <!-- Logo -->
    <div>
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
        </a>
    </div>
    <ul class="flex">
        <!-- Navigation Links -->
        <li>
            <x-nav-link :href="url('/dashboard/products')" :active="request()->routeIs('admin.product')">
                Produtos
            </x-nav-link>
        </li>
        <li>
            <x-nav-link :href="url('/dashboard/categories')" :active="request()->routeIs('admin.category')">
               Categorias
            </x-nav-link>
        </li>
        <li>
            <x-nav-link :href="url('/dashboard/users')" :active="request()->routeIs('admin.user')">
                Usuários
            </x-nav-link>
        </li>
    </ul>



    <!-- Responsive Navigation Menu -->
    {{-- <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
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