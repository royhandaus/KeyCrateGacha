<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\boxcontroller;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrateController;
use App\Http\Controllers\GachaController;
use App\Http\Controllers\salescontroller;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\produkcontroller;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\inventorycontroller;
Route::get('/seller/gacha-history', [GachaController::class, 'sellerHistory'])->name('gacha.seller.history');

Route::post('/crate/unlock/{id}', [GachaController::class, 'unlock']);
Route::post('/crate/store-history', [GachaController::class, 'storeHistory']);


Route::get('/history', [CrateController::class, 'gachaHistory'])->name('history');

Route::get('/gacha-history', [CrateController::class, 'gachaHistory'])->name('gacha.history');

Route::get('/crate/edit/{id}', [CrateController::class, 'edit'])->name('crates.edit');
Route::put('/crate/update/{id}', [CrateController::class, 'update'])->name('crates.update');
Route::delete('/crate/delete/{id}', [CrateController::class, 'destroy'])->name('crates.destroy');

Route::get('/mycrates', [CrateController::class, 'showCrateByOwner'])->name('mycrates')->middleware('auth');

Route::get('/sales', [salescontroller::class, 'index'])->name('sales.index')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::post('/crates/store', [CrateController::class, 'store'])->name('crates.store');
});
Route::get('/addcrates', function () {
    return view('addcrates');
})->middleware('auth');


Route::get('/crate/key-count/{id}', [GachaController::class, 'checkKeyCount']);
Route::get('/crates', [CrateController::class, 'index'])->name('crates');
Route::get('/gacha/{id}', [CrateController::class, 'show'])->name('crates.show');
Route::post('/crate/unlock/{crateId}', [GachaController::class, 'unlock']);



Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/cart/add/{keyId}', [CartController::class, 'addToCart'])->name('add_to_cart');
Route::post('/cart/update/{keyId}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::post('/cart/remove/{keyId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/payment/success', [CartController::class, 'paymentSuccess']);
Route::post('/payment/success', [CartController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/success',function(){
    return view('payment.success-page');
})->name('success');





// Root route: redirect ke home kalau sudah login, login kalau belum
Route::get('/', function () {
    return auth()->check() ? redirect()->route('home') : redirect()->route('login');
});

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.custom');
Route::post('/login-guest', [AuthController::class, 'loginGuest'])->name('login.guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register Routes (connect ke UserController@register)
Route::get('/register', function () {
    return view('register');
})->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');

// Home and other pages (no middleware)
Route::get('/home', [Homecontroller::class, 'index'])->name('home');

Route::get('/store', [StoreController::class, 'showStore'])->name('store');
Route::get('/history', [CrateController::class, 'showHistory'])->name('gacha.history');

Route::get('/history', [HistoryController::class, 'index'])->name('history');
Route::get('/history/order/{id}', [HistoryController::class, 'showOrder'])->name('history.order');
Route::get('/history', [HistoryController::class, 'showHistory'])
    ->middleware('auth')
    ->name('history');

// Route::get('/inventory', [inventorycontroller::class, 'index'])->name('inventory');
Route::get('/inventory', [InventoryController::class, 'showInventory'])
     ->middleware('auth')
     ->name('inventory');
Route::get('/input_box', [boxcontroller::class, 'insert_box'])->name('inputbox');
Route::post('inputbox/notif', [boxcontroller::class, 'notif_box'])->name('box.insert');

Route::get('/input_key', [StoreController::class, 'insert_key'])->name('inputkey');
Route::post('inputkey/notif', [StoreController::class, 'notif_key'])->name('key.insert');

// Produk
Route::get('/product', [CrateController::class, 'showCrateByOwner'])->name('product')->middleware('auth');
Route::put('/product/update-stok', [CrateController::class, 'updateStok'])->name('product.update_stok');

Route::get('/product_add', function () {
    return view('product.addproduct');
})->name('productadd');
Route::get('/product/{id}/edit', [produkcontroller::class, 'edit'])->name('productedit');
Route::post('/product/store', [produkcontroller::class, 'produk'])->name('product.store');
Route::put('/product/{id}', [produkcontroller::class, 'update'])->name('product.update');
Route::put('/product/{id}/disable', [produkcontroller::class, 'disable'])->name('product.disable');

// Route::get('/crates', function () {
//     return view('crates');
// })->name('crates');

Route::get('/gacha/{crate}', function ($crate) {
    $allowed = ['celestic', 'dust', 'eclipse', 'ironfang', 'nebula', 'oracle'];
    if (in_array($crate, $allowed)) {
        $viewPath = "gacha." . $crate;
        if (view()->exists($viewPath)) {
            return view($viewPath);
        }
        abort(404, "View file for crate '$crate' not found.");
    }
    abort(404);
})->name('gacha');

Route::get('/crate/add', function () {
    return view('addcrates');
})->name('crate.add');
Route::post('/crate/unlock/{crateId}', [GachaController::class, 'unlock'])->name('crate.unlock');


// Route::get('/wishlist', function () {
//     return view('wishlist');
// })->name('wishlist');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/{keyId}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::post('/wishlist/move-to-cart/{id}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');



// OTP & Reset Password
Route::get('/otp', [OTPController::class, 'form'])->name('otp.form');
Route::get('/send-otp', [OTPController::class, 'sendOtpFromForm']); // AJAX
Route::post('/verify-otp', [OTPController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/reset-password-form', [OTPController::class, 'resetForm'])->name('password.form');
Route::post('/reset-password', [OTPController::class, 'resetPassword'])->name('password.update');

// Forget password page
Route::get('/forget', function () {
    return view('forgotpassword');
})->name('forget');





// // Jangan lupa hapus route reset-password duplikat yang lain

// <?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\boxcontroller;
// use App\Http\Controllers\cartcontroller;
// use App\Http\Controllers\Homecontroller;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\StoreController;
// use App\Http\Controllers\HistoryController;
// use App\Http\Controllers\inventorycontroller;
// use App\Http\Controllers\produkcontroller;
// use App\Http\Controllers\OTPController;

// Route::get('/otp', [OTPController::class, 'form'])->name('otp.form');
// Route::get('/send-otp', [OTPController::class, 'sendOtpFromForm']); // AJAX
// Route::post('/verify-otp', [OTPController::class, 'verifyOtp'])->name('otp.verify');
// Route::get('/reset-password-form', [OTPController::class, 'resetForm'])->name('password.form');
// Route::post('/reset-password', [OTPController::class, 'resetPassword'])->name('password.update');

// // Route::get('/', function () {
// //     return view('welcome');
// // });
// Route::post('/login', [UserController::class, 'login'])->name('login.custom');

// Route::get('/login', function () {
//     return view('login'); // Pastikan ini mengarah ke file login.blade.php kamu
// })->name('login');

// Route::post('/logout',[UserController::class,'logout'])->name('logout');

// Route::get('/register', function () {
//     return view('register');
// })->name('register.form');

// Route::post('/register', [UserController::class, 'register'])->name('register.submit');


// // Route::get('/',function(){
// //     return view('home');
// // });

// Route::get('/store', [StoreController::class, 'showStore'])->name('store');
// Route::get('/history', [UserController::class, 'history'])->name('history');
// Route::get('/cart', [CartController::class, 'showCart'])->name('cart.view');
// Route::get('/crates', function () {
//     return view('crates');
// })->name('crates');

// Route::get('/gacha/{crate}', function ($crate) {
//     $allowed = ['celestic', 'dust', 'eclipse', 'ironfang', 'nebula', 'oracle'];

//     if (in_array($crate, $allowed)) {
//         $viewPath = "gacha." . $crate;

//         if (view()->exists($viewPath)) {
//             return view($viewPath)
//             ;
//         } else {
//             abort(404, "View file for crate '$crate' not found.");
//         }
//     }
//     abort(404);
// })->name('gacha');

// // Route::post('/login', function () {
// //     // Auth::logout();
// //     return redirect('/login');
// // })->name('login');

// Route::get('/inventory', [inventorycontroller::class, 'index'])->name('inventory');
// Route::get('/cart', [cartcontroller::class, 'showCart'])->name('cart');
// // Tambah ke cart
// Route::post('/cart/add/{key}', [CartController::class, 'addToCart'])->name('add_to_cart');

// Route::post('/checkout', [cartcontroller::class, 'checkout'])->name('checkout');

// Route::get('/input_box',[boxcontroller::class,'insert_box'])
//     ->name('inputbox');

// Route::post('inputbox/notif',[boxcontroller::class,'notif_box'])
//     ->name('box.insert');


// Route::get('/', [Homecontroller::class, 'index'])->name('home');

// Route::get('/history', [HistoryController::class, 'index'])->name('history');
// Route::get('/history/order/{id}', [HistoryController::class, 'showOrder'])->name('history.order');

// // produk
// Route::get('/product', [ProdukController::class, 'show_produk'])->name('product');
 
// Route::get('/product_add',function(){
//     return view('product.addproduct');
// })->name('productadd');
 
// Route::get('/product/{id}/edit', [ProdukController::class, 'edit'])->name('productedit');

// Route::get('/product/add', function () {
//     return view('product.addproduct');
// })->name('productadd');
 
// Route::post('/product/insert', function () {
//     // handle dummy insert
//     return redirect()->route('product')->with('success', 'Product has been added.');
// })->name('product.insert');

// Route::post('/product/store', [produkcontroller::class, 'produk'])->name('product.store');
// Route::put('/product/{id}', [ProdukController::class, 'update'])->name('product.update');
// Route::put('/product/{id}/disable', [ProdukController::class, 'disable'])->name('product.disable');
// //produk

// Route::get('/input_key',[StoreController::class,'insert_key'])
//     ->name('inputkey');

// Route::post('inputkey/notif',[StoreController::class,'notif_key'])
//     ->name('key.insert');

// // Tampilkan form add crate
// Route::get('/crate/add', function () {
//     return view('addcrates'); // pastikan nama file Blade kamu crate/add.blade.php
// })->name('crate.add');

// Route::get('/wishlist', function () {
//     return view('wishlist');
// })->name('wishlist');

// Route::get('/editcart', function () {
//     return view('editcart');
// })->name('editcart');

// Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
// Route::get('/forget', function () {
//     return view('forgotpassword');
// });
// Route::post('/reset-password', [UserController::class, 'reset_password'])->name('password.reset');
