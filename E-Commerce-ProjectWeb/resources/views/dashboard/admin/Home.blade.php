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
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg">
                                    <div class="absolute inset-0 bg-gray-900 bg-opacity-50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <a href="{{ route('buyer.products.show', $product->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 mb-2">
                                            View Details
                                        </a>
                                        <form action="{{ route('buyer.cart.store') }}" method="POST" class="mb-2">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                                Add to Cart
                                            </button>
                                        </form>
                                        <form action="{{ route('buyer.favorites.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                                                Add to Favorites
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h4 class="text-lg font-semibold">{{ $product->name }}</h4>
                                    <p class="text-gray-800 font-bold">${{ number_format($product->price, 2) }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <!-- Daftar Toko -->
                    <h3 class="text-lg font-medium mb-4">Available Stores</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($stores as $store)
                            <li class="bg-gray-100 rounded-lg shadow p-4">
                                <a href="{{ route('buyer.dashboard', ['store_id' => $store->id]) }}">
                                    <img src="{{ asset('storage/' . $store->image) }}" alt="{{ $store->name }}" class="w-full h-48 object-cover rounded-t-lg">
                                    <h4 class="text-lg font-semibold mt-4">{{ $store->name }}</h4>
                                    <p class="text-gray-600">{{ $store->description }}</p>
                                </a>
                            </li>
                        @empty
                            <p class="text-gray-600">No stores available.</p>
                        @endforelse
                    </ul>
                @endisset
            </div>
        </div>
    </div>
</x-app-layout>
