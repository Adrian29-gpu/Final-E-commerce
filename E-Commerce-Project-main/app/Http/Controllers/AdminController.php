<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store; // Pastikan Anda memiliki model Store
use App\Models\Product; // Pastikan Anda memiliki model Product

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    public function adminHome()
    {
        $userCount = User::count();
        $stores = Store::all(); // Ambil semua data toko dari database
        return view('dashboard.admin.AdminHome', compact('userCount', 'stores')); // Kirim data toko ke view
    }

    // Menampilkan seluruh produk dari semua toko
    public function manageProducts()
    {
        $products = Product::all(); // Mengambil semua produk dari seluruh toko
        return view('dashboard.admin.products.index', compact('products')); // Mengirim data produk ke view
    }

    // Menghapus produk
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete(); // Menghapus produk

        // Redirect kembali ke halaman produk dengan pesan sukses
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }
}

