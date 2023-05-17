<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Admin\AdminCategoriesComponent;
use App\Http\Livewire\Admin\AdminAddCategoriesComponent;
use App\Http\Livewire\Admin\AdminEditCategoriesComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent; 
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminaAddHomeSlideComponent;
use App\Http\Livewire\Admin\AdminaEditHomeSlideComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\SearchComponent;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PapPalController;
use App\Http\Livewire\AboutComponent;
use App\Http\Livewire\ContactComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',HomeComponent::class)->name('home.index');

Route::get('/shop',ShopComponent::class)->name('shop');

Route::get('/about',AboutComponent::class)->name('about');

Route::get('/contact',ContactComponent::class)->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/product/{slug}',DetailsComponent::class)->name('product.details');

Route::get('/cart',CartComponent::class)->name('shop.cart');

Route::get('/checkout',CheckoutComponent::class)->name('shop.checkout');

Route::get('/product-category/{slug}',CategoryComponent::class)->name('product.category');

Route::get('/search',SearchComponent::class)->name('product.search');

Route::get('go-payment', [PapPalController::class, 'goPayment'])->name('payment.go');

Route::get('payment',[PapPalController::class, 'payment'])->name('payment');
Route::get('cancel',[PapPalController::class, 'cancel'])->name('payment.cancel');
Route::get('payment/success', [PapPalController::class, 'success'])->name('payment.success');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard',UserDashboardComponent::class)->name('user.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/categories',AdminCategoriesComponent::class)->name('admin.categories');
    Route::get('/admin/category/add',AdminAddCategoriesComponent::class)->name('admin.category.add');
    Route::get('/admin/category/edit/{category_id}',AdminEditCategoriesComponent::class)->name('admin.category.edit');
    Route::get('/admin/products',AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/product/add',AdminAddProductComponent::class)->name('admin.product.add');
    Route::get('/admin/product/edit/{product_id?}',AdminEditProductComponent::class)->name('admin.product.edit');
    Route::get('/admin/slider',AdminHomeSliderComponent::class)->name('admin.home.slider');
    Route::get('/admin/slider/add',AdminaAddHomeSlideComponent::class)->name('admina.home.slide.add');
    Route::get('/admin/slider/edit/{slide_id}',AdminaEditHomeSlideComponent::class)->name('admina.home.slide.edit');

});

require __DIR__.'/auth.php';
