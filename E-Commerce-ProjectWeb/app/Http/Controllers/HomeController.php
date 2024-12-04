<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    if (Auth::check()) {
        if (Auth::user()->role == 'admin') {
            if ($request->has('store_id')) {
                // Jika toko dipilih, tampilkan produk dari toko tersebut
                $store = \App\Models\Store::findOrFail($request->input('store_id'));
                $products = $store->products;
                return view('dashboard.admin.home', compact('store', 'products'));
            } else {
                // Jika belum ada toko dipilih, tampilkan daftar toko
                $stores = \App\Models\Store::all();
                return view('dashboard.admin.home', compact('stores'));
            }
        } elseif (Auth::user()->role == 'seller') {
            $store = Auth::user()->store;
            $productCount = $store->products()->count();
            $orderCount = Order::whereHas('orderDetails.product.store', function ($query) {
                $query->where('user_id', Auth::id());
            })->count();
            return view('dashboard.seller.Home', compact('productCount', 'orderCount'));
        }

        // Logic untuk buyer
        if (Auth::check() && Auth::user()->role == 'buyer') {
            if ($request->has('store_id')) {
                // Jika toko dipilih, tampilkan produk dari toko tersebut
                $store = \App\Models\Store::findOrFail($request->input('store_id'));
                $products = $store->products;
                return view('dashboard.buyer.home', compact('store', 'products'));
            } else {
                // Jika belum ada toko dipilih, tampilkan daftar toko
                $recommendedProducts = Product::inRandomOrder()->take(4)->get();
                $stores = \App\Models\Store::all();
                return view('dashboard.buyer.home', compact('stores', 'recommendedProducts'));
            }
        }
    } else {
        return redirect('login');
    }
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
