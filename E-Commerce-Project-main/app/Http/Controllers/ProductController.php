<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $store = Store::where('user_id', Auth::id())->firstOrFail();
        $products = Product::where('store_id', $store->id)->get();
        return view('dashboard.seller.product.index', compact('products'));
    }

    public function create()
    {
        return view('dashboard.seller.product.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Get store for the authenticated user
    $store = Store::where('user_id', Auth::id())->firstOrFail();

    // Upload image if available
    $imagePath = $request->file('image') 
        ? $request->file('image')->store('product_images', 'public') 
        : null;

    // Create new product
    Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'image' => $imagePath,
        'store_id' => $store->id,
    ]);

    return redirect()->route('seller.products.index')->with('success', 'Product created successfully.');
}


    public function show(Product $product)
    {
        return view('dashboard.buyer.productDetails', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('dashboard.seller.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Store new image
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }

        $product->update($request->all());

        return redirect()->route('seller.products.index')
                         ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('seller.products.index')
                         ->with('success', 'Product deleted successfully.');
    }

    public function createOrder(Request $request)
    {
        $product = null;
        if ($request->has('product_id')) {
            $product = Product::findOrFail($request->input('product_id'));
        }
        $cartItems = []; // Initialize as an empty array
        // Add logic to populate $cartItems if needed
        return view('dashboard.buyer.order.create', compact('product', 'cartItems'));
    }

    public function welcome()
    {
        try {
            $products = Product::all();
            return view('welcome', compact('products'));
        } catch (\Exception $e) {
            Log::error('Error fetching products for welcome page: ' . $e->getMessage());
            return redirect()->route('welcome')->withErrors('Failed to load products.');
        }
    }

    public function publicView()
{
    // Ambil 3 produk acak untuk ditampilkan sebagai rekomendasi
    $recommendedProducts = Product::inRandomOrder()->take(4)->get();

    // Ambil semua toko
    $stores = Store::all();

    // Ambil semua produk
    $products = Product::all();

    // Kirim data ke view
    return view('public', compact('recommendedProducts', 'stores', 'products'));
}
    

// Menampilkan semua toko, jika hanya ingin menampilkan toko saja
public function showStores()
{
    try {
        $stores = Store::all();  // Ambil semua toko
        return view('public', compact('stores'));  // Kirimkan data toko ke view public
    } catch (\Exception $e) {
        Log::error('Error fetching stores: ' . $e->getMessage());
        return redirect()->route('welcome')->withErrors('Failed to load stores.');
    }
}

public function buyNow(Request $request)
{
    $product = Product::find($request->product_id);
    $quantity = $request->quantity;
    $totalPrice = $product->price * $quantity;

    // Process the order with $totalPrice

    return view('order.summary', compact('product', 'quantity', 'totalPrice'));
}

public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")
                            ->orWhere('description', 'LIKE', "%{$query}%")
                            ->get();

        return view('dashboard.buyer.home', compact('products'));
    }


}