<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Favorite Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg sm:rounded-lg">
                <div class="p-6">
                    @if($favorites->isEmpty())
                        <p class="text-gray-700 text-center">You have no favorite products.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($favorites as $favorite)
                                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $favorite->product->image) }}" alt="{{ $favorite->product->name }}" class="w-full h-48 object-cover rounded-lg">
                                        <div class="absolute top-2 right-2 bg-white p-1 rounded-full shadow-md">
                                            <i class="fas fa-heart text-red-500"></i>
                                        </div>
                                    </div>
                                    <h3 class="mt-4 text-lg font-bold text-gray-900">{{ $favorite->product->name }}</h3>
                                    <p class="mt-2 text-gray-700">{{ $favorite->product->description }}</p>
                                    <p class="mt-2 text-red-600 font-semibold">${{ number_format($favorite->product->price, 2) }}</p>
                                    <div class="mt-4 flex space-x-4">
                                        <form action="{{ route('buyer.cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $favorite->product->id }}">
                                            <input type="hidden" name="amount" value="1">
                                            <button 
                                                type="submit"
                                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow"
                                            >
                                                Add to Cart
                                            </button>
                                        </form>
                                        <form action="{{ route('buyer.favorites.destroy', $favorite->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
