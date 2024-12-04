<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 shadow-md rounded-lg p-6">
                <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Product Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-600 mb-1">Product Name</label>
                        <input type="text" name="name" id="name" class="block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" required>
                    </div>

                    <!-- Product Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                        <textarea name="description" id="description" rows="4" class="block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" required></textarea>
                    </div>

                    <!-- Product Price -->
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-600 mb-1">Price</label>
                        <input type="number" name="price" id="price" class="block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" required>
                    </div>

                    <!-- Product Stock -->
                    <div class="mb-4">
                        <label for="stock" class="block text-sm font-medium text-gray-600 mb-1">Stock</label>
                        <input type="number" name="stock" id="stock" class="block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" required>
                    </div>

                    <!-- Product Image -->
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-600 mb-1">Product Image</label>
                        <input type="file" name="image" id="image" class="block w-full text-gray-500 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition duration-200">
                            Create Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>