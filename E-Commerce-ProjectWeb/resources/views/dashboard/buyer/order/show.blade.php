<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <!-- Order Summary -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Order Information</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Order ID:</p>
                            <p class="text-gray-800 dark:text-gray-200">{{ $order->id }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Order Date:</p>
                            <p class="text-gray-800 dark:text-gray-200">{{ $order->order_date }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Status:</p>
                            <p class="text-gray-800 dark:text-gray-200">{{ $order->status }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Amount:</p>
                            <p class="text-gray-800 dark:text-gray-200">${{ number_format($order->total_amount, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Product Details -->
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-6">Products Ordered</h3>
                <div class="space-y-4">
                    @foreach($order->orderDetails as $detail)
                        <div class="flex items-center bg-gray-100 dark:bg-gray-700 rounded-lg p-4 shadow">
                            <!-- Product Image -->
                            <div class="w-16 h-16 flex-shrink-0">
                                @if($detail->product->image)
                                    <img src="{{ asset('storage/' . $detail->product->image) }}" alt="{{ $detail->product->name }}" class="w-full h-full object-cover rounded-lg">
                                @else
                                    <div class="w-full h-full bg-gray-300 flex items-center justify-center rounded-lg">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Details -->
                            <div class="ml-4 flex-grow">
                                <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $detail->product->name }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Quantity: {{ $detail->quantity }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Price: ${{ number_format($detail->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
