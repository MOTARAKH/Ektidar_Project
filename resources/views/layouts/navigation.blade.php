<nav x-data="{ open: false }" class="bg-blue-500 border-b border-gray-100" style="background: #3b82f6; color: white;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <div style="text-align: center; color: white;">
                        <span style="font-size: 24px; font-weight: bold; font-family: 'Amiri'; display: block;">اقتدار</span>
                        <span style="font-size: 16px; display: block; font-family: 'Amiri';">تعبئة التربوية</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('profile.edit')" class="text-white">
                            {{ Auth::user()->name }}
                        </x-nav-link>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <x-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-white">
                                {{ __('Log Out') }}
                            </x-nav-link>
                        </form>
                    @endauth
                    @guest
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-white">
                            {{ __('Login') }}
                        </x-nav-link>
                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="text-white">
                            {{ __('Register') }}
                        </x-nav-link>
                    @endguest
                </div>
            </div>

            <!-- Hamburger Menu for Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-white-400 hover:text-white-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" style="color:black">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')" style="color:black">
                    {{ Auth::user()->name }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        style="color:black">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            @endauth
            @guest
                <x-responsive-nav-link :href="route('login')" style="color:black">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" style="color:black">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endguest
        </div>
    </div>
</nav>
<style>
    /* General Styles */
nav {
    background-color: #3b82f6;
    color: white;
    border-bottom: 1px solid #e5e7eb;
}

/* Container for the navigation menu */
.max-w-7xl {
    max-width: 1280px;
    margin: 0 auto;
    padding-left: 1rem;
    padding-right: 1rem;
}

.flex {
    display: flex;
    justify-content: space-between;
    height: 4rem;
}

.shrink-0 {
    flex-shrink: 0;
}

.items-center {
    align-items: center;
}

/* Logo section */
.shrink-0 div {
    text-align: center;
    color: white;
}

.shrink-0 div span:first-child {
    font-size: 24px;
    font-weight: bold;
    font-family: 'Amiri', serif;
    display: block;
}

.shrink-0 div span:last-child {
    font-size: 16px;
    display: block;
    font-family: 'Amiri', serif;
}

/* Navigation Links */
.x-nav-link, .x-responsive-nav-link {
    color: white;
    text-decoration: none;
    font-size: 1rem;
    font-weight: 500;
    transition: color 0.3s ease-in-out;
    padding: 0.5rem 1rem;
}

.x-nav-link:hover, .x-responsive-nav-link:hover {
    color: #dbeafe; /* Light blue on hover */
}

/* Form Inside Navigation Link */
form.inline {
    display: inline;
    margin: 0;
    padding: 0;
}

form .x-nav-link, form .x-responsive-nav-link {
    cursor: pointer;
}

/* Responsive Navigation */
.hidden {
    display: none;
}

.block {
    display: block;
}

.sm\\:hidden {
    display: none;
}

.sm\\:items-center {
    align-items: center;
}

.sm\\:ms-6 {
    margin-left: 1.5rem;
}

.sm\\:ms-10 {
    margin-left: 2.5rem;
}

.border-gray-200 {
    border-color: #e5e7eb;
}

/* Mobile Menu Button */
.-me-2 {
    margin-right: -0.5rem;
}

.p-2 {
    padding: 0.5rem;
}

.rounded-md {
    border-radius: 0.375rem;
}

.text-gray-400 {
    color: #9ca3af;
}

.hover\\:text-gray-500:hover {
    color: #6b7280;
}

.hover\\:bg-gray-100:hover {
    background-color: #f3f4f6;
}

.focus\\:outline-none:focus {
    outline: 0;
}

.focus\\:bg-gray-100:focus {
    background-color: #f3f4f6;
}

.focus\\:text-gray-500:focus {
    color: #6b7280;
}

.transition {
    transition: all 0.15s ease-in-out;
}

.duration-150 {
    transition-duration: 0.15s;
}

.ease-in-out {
    transition-timing-function: ease-in-out;
}

</style>
