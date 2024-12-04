<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Stores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-6 text-center">Store Profile</h3>
    
                    @forelse($stores as $store)
                        <div class="mb-6 bg-gray-100 rounded-lg shadow-md p-6 max-w-md mx-auto">
                            <!-- Store Image -->
                            <div class="relative h-48 w-full rounded-t-lg overflow-hidden">
                                @if ($store->image)
                                    <img src="{{ asset('storage/' . $store->image) }}" alt="{{ $store->name }}" class="h-full w-full object-cover object-center">
                                @else
                                    <div class="h-full w-full bg-gray-300 flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                            </div>
                            
    
                            <!-- Store Name -->
                            <div class="mt-4 text-center">
                                <h4 class="text-xl font-bold text-gray-800">{{ $store->name }}</h4>
                            </div>
    
                            <!-- Store Details -->
                            <div class="mt-6 space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Address</label>
                                    <p class="text-gray-600">{{ $store->address }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <p class="text-gray-600">{{ $store->email }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Description</label>
                                    <p class="text-gray-600">{{ $store->description }}</p>
                                </div>
                            </div>
    
                            <!-- Edit Button -->
                            <div class="mt-6 flex justify-center">
                                <a href="{{ route('seller.stores.edit', $store->id) }}" class="inline-block bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700">
                                    Edit Store
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center">
                            <p class="text-gray-500">You have no stores yet. Create your first store now!</p>
                            <a href="{{ route('seller.stores.create') }}" class="mt-4 inline-block bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700">
                                Create Store
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
