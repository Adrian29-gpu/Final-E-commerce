<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Store') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('seller.stores.update', $store->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-6 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                <input type="text" name="name" value="{{ old('name', $store->name) }}" class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 text-gray-900 focus:ring-blue-500 focus:border-blue-500 p-2" required>
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <input type="text" name="address" value="{{ old('address', $store->address) }}" class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 text-gray-900 focus:ring-blue-500 focus:border-blue-500 p-2">
                                @error('address')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $store->email) }}" class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 text-gray-900 focus:ring-blue-500 focus:border-blue-500 p-2">
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea name="description" class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 text-gray-900 focus:ring-blue-500 focus:border-blue-500 p-2" rows="4">{{ old('description', $store->description) }}</textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                                @if ($store->image)
                                    <img src="{{ asset('storage/' . $store->image) }}" alt="{{ $store->name }}" class="h-32 w-32 object-cover mb-4 rounded-lg shadow">
                                @endif
                                <input type="file" name="image" class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 text-gray-900 focus:ring-blue-500 focus:border-blue-500 p-2">
                                @error('image')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring focus:ring-blue-500 transition duration-200">Update Store</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>