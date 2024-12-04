<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @isset($store)
                {{ __('Products from ' . $store->name) }}
            @else
                {{ __('Stores') }}
            @endisset
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                
                
                @isset($store)
                    <!-- Produk dari Toko Tertentu -->
                    <h3 class="text-lg font-medium mb-4">Products from {{ $store->name }}</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($products as $product)
                            <li class="relative bg-gray-100 rounded-lg shadow group p-4">
                                <!-- Gambar Produk -->
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg">
                    
                                    <!-- Hover Actions -->
                                    <div class="absolute inset-0 bg-gray-900 bg-opacity-50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <!-- View Details -->
                                        <a href="{{ route('buyer.products.show', $product->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 mb-2">
                                            View Details
                                        </a>
                    
                                        <!-- Add to Cart -->
                                        <form action="{{ route('buyer.cart.store') }}" method="POST" class="mb-2">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                                Add to Cart
                                            </button>
                                        </form>
                    
                                        <!-- Add to Favorites -->
                                        <form action="{{ route('buyer.favorites.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                                                Add to Favorites
                                            </button>
                                        </form>
                                    </div>
                                </div>
                    
                                <!-- Nama dan Harga Produk -->
                                <div class="mt-4">
                                    <h4 class="text-lg font-semibold">{{ $product->name }}</h4>
                                    <p class="text-gray-800 font-bold">${{ number_format($product->price, 2) }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    
                    

                @else
                <div class="text-center bg-white p-10 rounded-lg shadow-lg">
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to TokoKita Website</h1>
                    <p class="text-gray-600 mb-8">Find great products and offers just for you!</p>
                
            
                    <!-- Produk Rekomendasi -->
                    <div class="mb-9">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recommended Products</h2>
                        <div class="flex justify-center space-x-4">
                            @foreach($recommendedProducts as $product)
                                <div class="bg-gray-100 p-4 rounded-lg shadow-md w-1/3 group relative overflow-hidden">
                                    <!-- Gambar Produk -->
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-md mb-4">
                    
                                    <!-- Nama dan Deskripsi Produk -->
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                                    <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                    
                                    <!-- Harga Produk -->
                                    <span class="text-xl font-bold text-blue-500">{{ number_format($product->price, 2) }}</span>
                    
                                    <!-- Tombol Hover yang Akan Muncul saat Hover pada Produk -->
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gray-800 bg-opacity-50">
                                        @if (!Auth::check())
                                            <!-- Tombol jika pengguna belum login -->
                                            <a href="{{ route('welcome') }}" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition duration-300 mr-2">Add to Cart</a>
                                            <a href="{{ route('welcome') }}" class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition duration-300">Add to Favorite</a>
                                        @else
                                            <!-- Tombol jika pengguna sudah login -->
                                            <form action="{{ route('buyer.cart.store') }}" method="POST" class="mr-2">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition duration-300">Add to Cart</button>
                                            </form>
                                            <form action="{{ route('buyer.favorites.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition duration-300">Add to Favorite</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
                    <br>
                    <!-- Daftar Toko -->
                    <h3 class="text-lg font-medium mb-4">Available Stores</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($stores as $store)
                            <li class="bg-gray-100 rounded-lg shadow p-4">
                                <a href="{{ route('buyer.dashboard', ['store_id' => $store->id]) }}">
                                    <img src="{{ asset('storage/' . $store->image) }}" alt="{{ $store->name }}" class="w-full h-48 object-cover rounded-t-lg">
                                    <h4 class="text-lg font-semibold mt-4">{{ $store->name }}</h4>
                                    <p class="text-gray-600">{{ $store->description }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endisset
            </div>
        </div>
    </div>
</x-app-layout>
