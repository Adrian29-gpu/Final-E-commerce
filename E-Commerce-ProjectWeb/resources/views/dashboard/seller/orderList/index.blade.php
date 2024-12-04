<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seller Dashboard - Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    @forelse ($orders as $order)
                        <div class="mb-6 p-4 border border-gray-200 rounded-lg shadow-sm">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-700">Order ID: {{ $order->id }}</h3>
                                    <p class="text-sm text-gray-500">Order Date: {{ $order->order_date }}</p>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <span class="px-2 py-1 rounded-full {{ $order->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $order->status }}
                                    </span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <p class="text-gray-700">Total Amount: <span class="font-semibold">${{ $order->total_amount }}</span></p>
                            </div>
                            <div>
                                <h4 class="text-md font-semibold text-gray-700 mb-2">Order Details:</h4>
                                <ul class="list-disc list-inside text-gray-600">
                                    @foreach ($order->orderDetails as $detail)
                                        <li>{{ $detail->product->name }} - {{ $detail->quantity }} x ${{ $detail->price }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @if ($order->status === 'Pending')
                                <div class="mt-4">
                                    <form action="{{ route('seller.orders.ship', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                                            Ship Order
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500">No orders available.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
