<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\webPage;
use App\Http\Controllers\CartController;
use App\Http\Controllers\wishlistController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\MyaccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [webPage::class, 'home']);
Route::get('/search', [SearchController::class, 'search']);
Route::get('/about-us', [webPage::class, 'about_us']);
Route::get('/privacy-policy', [webPage::class, 'privacy']);
Route::get('/terms-of-service', [webPage::class, 'terms']);
Route::get('/contact-us', [webPage::class, 'contact_us']);
Route::post('/contact-us', [webPage::class, 'support_process']);
Route::get('/faqs', [webPage::class, 'faqs']);
Route::get('/shipping-policy', [webPage::class, 'shipping']);
Route::get('/cancellation-policy', [webPage::class, 'cancellation']);
Route::get('/return-policy', [webPage::class, 'return_policy']);
Route::post('/sign-up', [webPage::class, 'new_subscribers']);

Route::get('/vitality-quiz', [webPage::class, 'get_quiz']);
Route::post('/vitality-quiz', [webPage::class, 'post_quiz']);

Route::get('/roots-of-vitality', [webPage::class, 'roots_vitality']);

Route::get('/shop/{type}', [webPage::class, 'shop2']);
Route::get('/shop/{type}/{product_url}', [webPage::class, 'product']);

Route::get('cart-count', [webPage::class, 'getCount']);
Route::get('cart-update', [webPage::class, 'cartUpdate']);

Route::resource('cart', CartController::class);
Route::get('/checkout.check-stock', [checkoutController::class, 'checkStock'])->name('checkout.check-stock');
Route::get('/checkout/contact-information', [checkoutController::class, 'information'])->name('checkout.contact-information');
Route::post('/checkout/contact-information', [checkoutController::class, 'contact_information']);
Route::get('/checkout/login', [checkoutController::class, 'login']);
Route::post('/checkout/login', [checkoutController::class, 'loggedIn']);
Route::get('/checkout/shipping-method', [checkoutController::class, 'shipping']);
Route::post('/checkout/shipping-method',[checkoutController::class, 'shipping_method']);
Route::get('/checkout/payment-method', [checkoutController::class, 'payment']);
Route::post('/checkout/payment-method', [checkoutController::class, 'payment_method']);
Route::post('/checkout/apply-discount-code', [checkoutController::class, 'apply_discountCode']);
Route::post('/checkout/remove-discount-code', [checkoutController::class, 'remove_discountCode']);
Route::get('/checkout/review', [checkoutController::class, 'review']);
Route::post('/orders', [checkoutController::class, 'order']);
Route::get('/order-confirmation/{order_number}', [checkoutController::class, 'order_confirmation']);
Route::get('/orders/{order_number}', [checkoutController::class, 'thank_you_page']);
Route::get('/event-trigger/{order_number}', [checkoutController::class, 'order_eventTrigger']);
Route::get('/track-your-order', [webPage::class, 'trackOrder']);

Route::get('/myaccount', [MyaccountController::class, 'index'])->name('home')->middleware('verified');
Route::post('/myaccount', [MyaccountController::class, 'update_info'])->middleware('verified');
Route::get('/myorders', [MyaccountController::class, 'myorders'])->middleware('verified');
Route::get('/myorders/{orderID}', [MyaccountController::class, 'myorder'])->middleware('verified');

Route::get('admin', [AdminController::class, 'index'])->middleware('verified');
Route::get('admin/orders', [AdminController::class, 'orders'])->middleware('verified');
Route::get('admin/orders/{orderID}', [AdminController::class, 'order'])->middleware('verified');
Route::post('admin/orders/{orderID}/shipped', [AdminController::class, 'order_shipped'])->middleware('verified');
Route::get('admin/orders/{orderID}/fulfilled', [AdminController::class, 'order_fulfilled'])->middleware('verified');
Route::get('admin/orders/{orderID}/cancelled', [AdminController::class, 'order_cancelled'])->middleware('verified');

Route::POST('admin/orders/{orderID}/update', [AdminController::class, 'order_edit'])->middleware('verified');
Route::get('admin/orders/{orderID}/invoice', [AdminController::class, 'invoice'])->middleware('verified');
Route::get('admin/checkouts', [AdminController::class, 'checkouts'])->middleware('verified');
Route::get('admin/checkouts/{checkoutID}', [AdminController::class, 'checkout'])->middleware('verified');
Route::get('admin/products', [AdminController::class, 'products'])->middleware('verified');
Route::get('admin/products/new', [AdminController::class, 'product_new'])->middleware('verified');
Route::POST('admin/products/new', [AdminController::class, 'product_store'])->middleware('verified');
Route::get('admin/products/{productID}', [AdminController::class, 'product'])->middleware('verified');
Route::post('admin/products/{productID}/edit', [AdminController::class, 'product_edit'])->middleware('verified');
Route::get('admin/collections', [AdminController::class, 'collections'])->middleware('verified');
Route::get('admin/collections/new', [AdminController::class, 'collections_new'])->middleware('verified');
Route::post('admin/collections/new', [AdminController::class, 'collections_store'])->middleware('verified');
Route::get('admin/collections/{collectionID}', [AdminController::class, 'collection'])->middleware('verified');
Route::post('admin/collections/{collectionID}/edit', [AdminController::class, 'collection_edit'])->middleware('verified');
Route::post('admin/collection/{collectionID}/image', [AdminController::class, 'collection_image'])->middleware('verified');
Route::get('admin/categories', [AdminController::class, 'categories'])->middleware('verified');
Route::get('admin/categories/new', [AdminController::class, 'categories_new'])->middleware('verified');
Route::post('admin/categories/new', [AdminController::class, 'categories_store'])->middleware('verified');
Route::get('admin/categories/{categorieID}', [AdminController::class, 'categorie'])->middleware('verified');
Route::post('admin/categories/{categorieID}/edit', [AdminController::class, 'categorie_edit'])->middleware('verified');
Route::post('admin/categorie/{categorieID}/image', [AdminController::class, 'categorie_image'])->middleware('verified');
Route::get('admin/categories/{categorieID}/delete', [AdminController::class, 'categorie_delete'])->middleware('verified');

Route::get('admin/sub-categories', [AdminController::class, 'sub_categories'])->middleware('verified');
Route::get('admin/sub-categories/new', [AdminController::class, 'sub_categories_new'])->middleware('verified');
Route::post('admin/sub-categories/new', [AdminController::class, 'sub_categories_store'])->middleware('verified');
Route::get('admin/sub-categories/{categorieID}', [AdminController::class, 'sub_categorie'])->middleware('verified');
Route::post('admin/sub-categories/{categorieID}/edit', [AdminController::class, 'sub_categorie_edit'])->middleware('verified');
Route::post('admin/sub-categorie/{categorieID}/image', [AdminController::class, 'sub_categorie_image'])->middleware('verified');
Route::get('admin/sub-categories/{categorieID}/delete', [AdminController::class, 'sub_categorie_delete'])->middleware('verified');

Route::get('admin/lookbooks', [AdminController::class, 'moodboards'])->middleware('verified');
Route::get('admin/lookbooks/new', [AdminController::class, 'moodboards_new'])->middleware('verified');
Route::post('admin/lookbooks/new', [AdminController::class, 'moodboards_store'])->middleware('verified');
Route::get('admin/lookbooks/{id}', [AdminController::class, 'moodboard'])->middleware('verified');
Route::post('admin/lookbooks/{id}', [AdminController::class, 'moodboard_update'])->middleware('verified');
Route::post('admin/lookbooks/{id}/tag-product/{productNumber}', [AdminController::class, 'moodboard_tagProduct'])->middleware('verified');
Route::DELETE('/lookbook', [AdminController::class, 'lookbook_delete'])->middleware('verified');
Route::DELETE('/lookbookImage', [AdminController::class, 'delete_image_lookbook'])->middleware('verified');
Route::POST('/lookbookImage/{lookbookID}', [AdminController::class, 'add_image_lookbook'])->middleware('verified');

Route::get('admin/customers', [AdminController::class, 'customers'])->middleware('verified');
Route::get('admin/customer/{customerID}', [AdminController::class, 'customer'])->middleware('verified');
Route::get('admin/discounts', [AdminController::class, 'discounts'])->middleware('verified');
Route::get('/admin/discounts/generate-code', [AdminController::class, 'generate_code'])->middleware('verified');
Route::get('admin/discounts/code/new', [AdminController::class, 'discount_code_new'])->middleware('verified');
Route::POST('admin/discounts/code/new', [AdminController::class, 'discount_code_store'])->middleware('verified');
Route::get('admin/discounts/code/{discountID}', [AdminController::class, 'discount_code'])->middleware('verified');
Route::POST('admin/discounts/code/{discountID}', [AdminController::class, 'discount_code_update'])->middleware('verified');
Route::DELETE('admin/discounts/code/{discountID}', [AdminController::class, 'discount_code_delete'])->middleware('verified');
Route::get('admin/discounts/automatic/new', [AdminController::class, 'automatic_discount_new'])->middleware('verified');
Route::POST('admin/discounts/automatic/new', [AdminController::class, 'automatic_discount_store'])->middleware('verified');
Route::get('admin/discounts/automatic/{discountID}', [AdminController::class, 'automatic_discount'])->middleware('verified');
Route::POST('admin/discounts/automatic/{discountID}', [AdminController::class, 'automatic_discount_update'])->middleware('verified');
Route::DELETE('admin/discounts/automatic/{discountID}', [AdminController::class, 'automatic_discount_delete'])->middleware('verified');

Route::PATCH('/users/edit', [AdminController::class, 'users_edit'])->middleware('verified');
Route::DELETE('/product', [AdminController::class, 'product_delete'])->middleware('verified');
Route::DELETE('/image', [AdminController::class, 'delete_image'])->middleware('verified');
Route::POST('/image/{productID}', [AdminController::class, 'add_image'])->middleware('verified');
Route::get('/admin/settings', [AdminController::class, 'settings'])->middleware('verified');
Route::get('/admin/settings/payments', [AdminController::class, 'payments'])->middleware('verified');
Route::get('/admin/settings/payments/cash-on-delivery', [AdminController::class, 'payments_cod'])->middleware('verified');
Route::POST('/admin/settings/payments/cash-on-delivery/new', [AdminController::class, 'payments_cod_new'])->middleware('verified');
Route::POST('/admin/settings/payments/cash-on-delivery/update', [AdminController::class, 'payments_cod_update'])->middleware('verified');
Route::DELETE('/admin/settings/payments/cash-on-delivery/delete', [AdminController::class, 'payments_cod_delete'])->middleware('verified');

Route::get('/admin/settings/shipping', [AdminController::class, 'shipping'])->middleware('verified');
Route::get('/admin/settings/shipping/{country}', [AdminController::class, 'shipping_manage'])->middleware('verified');
Route::POST('/admin/settings/shipping/new', [AdminController::class, 'shipping_addNew'])->middleware('verified');
Route::POST('/admin/settings/shipping/update', [AdminController::class, 'shipping_update'])->middleware('verified');
Route::DELETE('/admin/settings/shipping/delete', [AdminController::class, 'shipping_delete'])->middleware('verified');
Route::get('/admin/settings/taxes', [AdminController::class, 'taxes'])->middleware('verified');
Route::get('/admin/settings/taxes/{country}', [AdminController::class, 'taxes_edit'])->middleware('verified');
Route::POST('/admin/settings/taxes/{country}', [AdminController::class, 'taxes_store'])->middleware('verified');

Route::get('/admin/homepage/slider', [AdminController::class, 'slider'])->middleware('verified');
Route::get('/admin/homepage/slider/new', [AdminController::class, 'slider_new'])->middleware('verified');
Route::POST('/admin/homepage/slider/new', [AdminController::class, 'slider_store'])->middleware('verified');
Route::get('/admin/homepage/slider/{id}', [AdminController::class, 'slider_edit'])->middleware('verified');
Route::POST('/admin/homepage/slider/{id}', [AdminController::class, 'slider_update'])->middleware('verified');
Route::POST('/admin/homepage/slider/{id}/image', [AdminController::class, 'slider_image'])->middleware('verified');
Route::get('/admin/homepage/slider/{id}/delete', [AdminController::class, 'slider_delete'])->middleware('verified');

Route::get('/admin/homepage/announcement', [AdminController::class, 'announcement'])->middleware('verified');
Route::post('/admin/homepage/announcement', [AdminController::class, 'announcementBar'])->middleware('verified');

Route::get('/admin/homepage/image-with-text-overlay', [AdminController::class, 'image_with_text_overlay'])->middleware('verified');
Route::get('/admin/homepage/image-with-text-overlay/new', [AdminController::class, 'image_with_text_overlay_new'])->middleware('verified');
Route::POST('/admin/homepage/image-with-text-overlay/new', [AdminController::class, 'image_with_text_overlay_store'])->middleware('verified');
Route::get('/admin/homepage/image-with-text-overlay/{id}', [AdminController::class, 'image_with_text_overlay_edit'])->middleware('verified');
Route::POST('/admin/homepage/image-with-text-overlay/{id}', [AdminController::class, 'image_with_text_overlay_update'])->middleware('verified');
Route::POST('/admin/homepage/image-with-text-overlay/{id}/image', [AdminController::class, 'image_with_text_overlay_image'])->middleware('verified');
Route::get('/admin/homepage/image-with-text-overlay/{id}/delete', [AdminController::class, 'image_with_text_overlay_delete'])->middleware('verified');

Route::get('/admin/homepage/services', [AdminController::class, 'services'])->middleware('verified');
Route::get('/admin/homepage/services/new', [AdminController::class, 'services_new'])->middleware('verified');
Route::POST('/admin/homepage/services/new', [AdminController::class, 'services_store'])->middleware('verified');
Route::get('/admin/homepage/services/{id}', [AdminController::class, 'services_edit'])->middleware('verified');
Route::POST('/admin/homepage/services/{id}', [AdminController::class, 'services_update'])->middleware('verified');
Route::POST('/admin/homepage/services/{id}/image', [AdminController::class, 'services_image'])->middleware('verified');
Route::get('/admin/homepage/services/{id}/delete', [AdminController::class, 'services_delete'])->middleware('verified');


Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/{type}', [webPage::class, 'shop1']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/myaccount');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
