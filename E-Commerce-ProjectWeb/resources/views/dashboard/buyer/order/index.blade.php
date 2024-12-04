<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100">
            {{ __('Your Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6">
                    @if($orders->isEmpty())
                        <div class="text-center py-4">
                            <p class="text-gray-600 dark:text-gray-400">You have no orders.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white rounded-lg shadow-lg">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Order ID
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Order Date
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Total Amount
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Details
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                {{ $order->id }}
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                {{ $order->order_date }}
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-5 text-green-800 bg-green-200 rounded-full">
                                                    {{ $order->status }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                ${{ number_format($order->total_amount, 2) }}
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <a href="{{ route('buyer.orders.show', $order->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline">View Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>