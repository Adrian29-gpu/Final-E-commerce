<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex bg-gray-00">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-lg">
                <div class="p-4 border-b">
                    <h2 class="text-xl font-bold text-gray-800">{{ config('app.name', 'Laravel') }}</h2>
                </div>
                <nav class="mt-4">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.home') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                                {{ __('Dashboard') }}
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                                {{ __('Manage Users') }}
                            </a>
                            <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                                {{ __('Manage Products') }}
                            </a>
                        @elseif(Auth::user()->role === 'seller')
                            <a href="{{ route('seller.stores.index') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                                {{ __('Manage Stores') }}
                            </a>
                            <a href="{{ route('seller.products.index') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                                {{ __('Manage Products') }}
                            </a>
                            <a href="{{ route('seller.orders.index') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                                {{ __('Manage Orders') }}
                            </a>
                        @elseif(Auth::user()->role === 'buyer')
                            <a href="{{ route('dashboard') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                                {{ __('Home') }}
                            </a>
                            <a href="{{ route('buyer.orders.index') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                                {{ __('Orders') }}
                            </a>
                        @endif

                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'buyer')
                        <a href="{{ route('buyer.favorites.index') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                            {{ __('Favorites') }}
                        </a>
                        <a href="{{ route('buyer.cart.index') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">
                            {{ __('Cart') }}
                        </a>
                        @endif
                    @endauth
                </nav>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-grow flex flex-col">
                <!-- Topbar -->
                <header class="bg-white shadow px-4 py-3 flex justify-between items-center">
                    <!-- Cart and Favorites -->
                    {{-- <div class="flex space-x-4">
                        <a href="{{ route('buyer.favorites.index') }}" class="text-gray-600 hover:text-gray-800">
                            Favorites
                        </a>
                        <a href="{{ route('buyer.cart.index') }}" class="text-gray-600 hover:text-gray-800">
                            Cart
                        </a>
                    </div> --}}

                    <!-- User Profile Dropdown -->
                    <div>
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-800 hover:text-gray-600">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-grow p-6">
                    @if(isset($slot))
                        {{ $slot }}
                    @elseif(isset($content))
                        {{ $content }}
                    @endif
                </main>
            </div>
        </div>
    </body>
</html>
