<?php

use App\Http\Controllers\{
    HomeController,
    ProductBuyerController,
    ProfileController,
    UserController,
    AdminController,
    StoreController,
    ProductController,
    FavoriteController,
    CartController,
    OrderController
};
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'publicView'])->name('public');

// Halaman welcome jika pengguna belum login
Route::get('/welcome', [ProductController::class, 'welcome'])->name('welcome');
// Route::get('/', [ProductController::class, 'showWelcomePage']);
// Route untuk produk (akan mengarahkan ke welcome jika pengguna belum login)
Route::get('/product/{product}', function() {
    return view('welcome'); // Jika pengguna belum login, arahkan ke halaman welcome
})->name('product.show');

// Route lain untuk dashboard dan halaman profile (dengan autentikasi)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes untuk cart dan favorites
    Route::post('/cart/store', [CartController::class, 'store'])->name('buyer.cart.store');
    Route::post('/favorites/store', [FavoriteController::class, 'store'])->name('buyer.favorites.store');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('/admin/users', UserController::class)->names([
        'index'   => 'admin.users.index',
        'create'  => 'admin.users.create',
        'store'   => 'admin.users.store',
        'show'    => 'admin.users.show',
        'edit'    => 'admin.users.edit',
        'update'  => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    Route::get('/admin/home', [AdminController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/products', [AdminController::class, 'manageProducts'])->name('admin.products.index');
    Route::delete('/admin/products/{product}', [AdminController::class, 'deleteProduct'])->name('admin.products.destroy');
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', [HomeController::class, 'index'])->name('seller.dashboard');

    Route::resource('/seller/stores', StoreController::class)->names([
        'index'   => 'seller.stores.index',
        'create'  => 'seller.stores.create',
        'store'   => 'seller.stores.store',
        'show'    => 'seller.stores.show',
        'edit'    => 'seller.stores.edit',
        'update'  => 'seller.stores.update',
        'destroy' => 'seller.stores.destroy',
    ]);

    Route::resource('/seller/products', ProductController::class)->names([
        'index'   => 'seller.products.index',
        'create'  => 'seller.products.create',
        'store'   => 'seller.products.store',
        'show'    => 'seller.products.show',
        'edit'    => 'seller.products.edit',
        'update'  => 'seller.products.update',
        'destroy' => 'seller.products.destroy',
    ]);

    Route::get('/seller/orders', [OrderController::class, 'sellerOrderList'])->name('seller.orders.index');
    Route::get('/seller/orders/{order}', [OrderController::class, 'show'])->name('seller.orders.show');
    Route::get('/seller/orders/all', [OrderController::class, 'allOrdersFromBuyers'])->name('seller.orders.all');
    Route::patch('/seller/orders/{order}/ship', [OrderController::class, 'shipOrder'])->name('seller.orders.ship');
});

Route::middleware(['auth', 'role:buyer'])->group(function () {
    Route::get('/buyer/dashboard', [HomeController::class, 'index'])->name('buyer.dashboard');
    Route::get('/buyer/products/{product}', [ProductBuyerController::class, 'show'])->name('buyer.products.show');
    Route::get('/search', [ProductController::class, 'search'])->name('buyer.products.search');


    Route::post('/buyer/cart', [CartController::class, 'store'])->name('buyer.cart.store');
    Route::get('/buyer/cart', [CartController::class, 'index'])->name('buyer.cart.index');
    Route::patch('/buyer/cart/{cart}', [CartController::class, 'update'])->name('buyer.cart.update');
    Route::delete('/buyer/cart/{cart}', [CartController::class, 'destroy'])->name('buyer.cart.destroy');

    Route::resource('/buyer/favorites', FavoriteController::class)->names([
        'index'   => 'buyer.favorites.index',
        'store'   => 'buyer.favorites.store',
        'destroy' => 'buyer.favorites.destroy',
    ]);

    Route::resource('/buyer/orders', OrderController::class)->only(['create', 'store']);
    Route::get('/buyer/orders/create', [OrderController::class, 'create'])->name('buyer.orders.create');
    Route::post('/buyer/orders', [OrderController::class, 'store'])->name('buyer.orders.store');
    Route::post('/buyer/orders/details', [OrderController::class, 'storeOrderDetails'])->name('buyer.orders.details.store');
    Route::post('/buyer/orders/checkout', [OrderController::class, 'checkout'])->name('buyer.orders.checkout');
    Route::get('/buyer/orders', [OrderController::class, 'index'])->name('buyer.orders.index');
    Route::get('/buyer/orders/{order}', [OrderController::class, 'show'])->name('buyer.orders.show');
    Route::get('/buyer/orders/buy-now/{product}', [OrderController::class, 'buyNow'])->name('buyer.orders.buyNow');
    // Route::get('/buyer/orders/buy-now/{product}', [OrderController::class, 'buyNow'])->name('buyer.orders.buyNow');
});

require __DIR__ . '/auth.php';
