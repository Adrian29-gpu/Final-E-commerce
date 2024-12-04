<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TokoKita</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">
        <div class="flex flex-col h-screen bg-gray-100">
            <!-- Topbar -->
            <header class="bg-white shadow px-4 py-3 flex justify-between items-center">
                <!-- Website Name -->
                <div class="text-xl font-bold text-gray-800">TokoKita</div>
                
                <!-- Navigation Links -->
                <nav class="flex space-x-4">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.home') }}" class="nav-link">Dashboard</a>
                            <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
                            <a href="{{ route('admin.users.index') }}" class="nav-link">Manage Users</a>
                            <a href="{{ route('admin.products.index') }}" class="nav-link">Manage Products</a>
                            <a href="{{ route('buyer.orders.index') }}" class="nav-link">Orders</a>
                            <a href="{{ route('buyer.favorites.index') }}" class="nav-link">Favorites</a>
                            <a href="{{ route('buyer.cart.index') }}" class="nav-link">Cart</a>
                        @elseif(Auth::user()->role === 'seller')
                            <a href="{{ route('seller.stores.index') }}" class="nav-link">Manage Stores</a>
                            <a href="{{ route('seller.products.index') }}" class="nav-link">Manage Products</a>
                            <a href="{{ route('seller.orders.index') }}" class="nav-link">Manage Orders</a>
                        @elseif(Auth::user()->role === 'buyer')
                            <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
                            <a href="{{ route('buyer.orders.index') }}" class="nav-link">Orders</a>
                            <a href="{{ route('buyer.favorites.index') }}" class="nav-link">Favorites</a>
                            <a href="{{ route('buyer.cart.index') }}" class="nav-link">Cart</a>
                        @endif
                    @endauth
                </nav>
    
                <!-- User Profile -->
                <div>
                    @auth
                        <div class="relative">
                            <button id="user-menu-button" class="flex items-center text-sm font-medium text-gray-800 hover:text-gray-600 focus:outline-none">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-200">Log Out</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </header>
    
            <!-- Main Content -->
            <main class="flex-grow p-6 bg-gray-100">
                {{ $slot }}
            </main>
        </div>
    
        <script>
            document.getElementById('user-menu-button').addEventListener('click', function() {
                var menu = document.getElementById('user-menu');
                menu.classList.toggle('hidden');
            });
    
            // Highlight the active link
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                if (link.href === window.location.href) {
                    link.classList.add('active');
                }
            });
        </script>
    
    <style>
        .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background-color: #4A90E2; /* Change this color to your preferred hover color */
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #4A90E2; /* Change this color to your preferred hover color */
        }
    </style>
    </body>
</html>