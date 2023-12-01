<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebPagesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;

use  App\Http\Controllers\Admin\LoginController;
use  App\Http\Controllers\Admin\WebAdminController;
use  App\Http\Controllers\Admin\GrindController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CatelogController;


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

/**--   Web Pages routes  --*/
Route::get('/', function () {
    return view('index');
});

Route::get('contact_us',[WebPagesController::class,'contact_us']);
Route::post('user_queries',[WebPagesController::class, 'UserQuries']);

Route::get('termandconditions',[WebPagesController::class,'Terms']);

Route::get('blog',[WebPagesController::class,'blog']);
Route::get('shop',[WebPagesController::class,'shop']);
Route::get('product_detail/{slug}',[WebPagesController::class, 'ProductDetail']);
Route::get('type_data',[WebPagesController::class, 'TypeProduct']);

/**--   login/Registeration routes  --*/
Route::get('/login', [AuthController::class, 'AuthLogin'])->name('user.login');
Route::get('/register', [AuthController::class, 'AuthRegister']);
Route::post('auth/register',[AuthController::class, 'Registration'])->name('auth-register');
Route::get('/otp/{id}',[AuthController::class, 'Otp'])->name('otp.verification');
Route::post('submit/otp',[AuthController::class, 'SubmitOtp'])->name('submit-otp');
Route::get('resend/otp/{id}',[AuthController::class, 'ResendOtp'])->name('resend.otp');
Route::post('logged/in',[AuthController::class,'LoggedIn'])->name('logged-in');


/**--   Forget-Password routes  --*/
Route::get('forget_password',[AuthController::class, 'Forget_Password']);
Route::post('send/otp',[AuthController::class, 'SubmitRequest']);
Route::get('forget-password',[AuthController::class, 'verificationMail']);
Route::post('forget-password',[AuthController::class, 'ForgetPassword']);


/**--   Auth-User routes  --*/
Route::group(['middleware'=>'auth'], function(){
    Route::get('profile',[AuthController::class, 'Profile']);
    Route::post('update_profile/{id}',[AuthController::class, 'UpdateProfile']);
    Route::get('order_deatil/{id}',[AuthController::class, 'OrderDetail']);
    Route::post('rating',[WebPagesController::class, 'RateProduct']);
    
    // Route::get('cart',[WebPagesController::class,'cart']);
    Route::get('sign/out',[AuthController::class,'SignOut'])->name('sign-out');
});

// Cart Routes
Route::get('cart',[CartController::class, 'Cart']);
Route::post('add_to_cart',[CartController::class, 'Add_to_cart']);
Route::post('update_cart',[CartController::class, 'UpdateCart']);
Route::get('checkout',[CartController::class, 'Checkout']);
Route::get('remove_cart/{id}',[CartController::class, 'Cart_Remove']); 

//Payment Routes
Route::post('stripe',[PaymentController::class, 'GetStripe']);
Route::get('auth_stripe',[PaymentController::class, 'AuthStripe'])->name('stripe');
Route::get('guest_stripe',[PaymentController::class, 'GuestStripe'])->name('guest.stripe');
Route::post('stripe_post',[PaymentController::class, 'StripePost']);
Route::post('guest_payment',[PaymentController::class, 'GuestStripe'])->name('guest.payment');



//thankyou
Route::view('thankyou', 'thankyou');

/**--   Admin routes  --*/
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('adminLogin');
    Route::post('/login', [LoginController::class, 'postLogin'])->name('adminLoginPost');
    
    Route::group(['middleware' => 'adminauth'], function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('adminDashboard');
        Route::get('/logout',  [LoginController::class, 'adminLogout'])->name('adminLogout');
        Route::get('profile',[LoginController::class, 'profile']);
        Route::post('profile/post',[LoginController::class, 'profile_post']);
        
        Route::resource('grind',GrindController::class);  
        
        Route::get('terms',[WebadminController::class, 'terms']);
        Route::post('terms/post',[WebadminController::class, 'terms_post']);
        Route::get('type',[WebAdminController::class, 'Type']);
        Route::get('add_type',[WebAdminController::class, 'AddType']);
        Route::post('post_type',[WebAdminController::class, 'PostType']);
        Route::get('edit_type/{id}',[WebAdminController::class, 'EditType']);
        Route::post('update_type/{id}',[WebAdminController::class, 'UpdateType']);
        Route::DELETE('delete_type/{id}',[WebAdminController::class, 'DeleteType']);
        
        Route::get('home_header',[WebAdminController::class, 'HomeHeader']);
        Route::post('update_heading/{id}',[WebAdminController::class, 'UpdateHeading']);
        Route::post('update_info/{id}',[WebAdminController::class, 'UpdateInfo']);
        Route::post('update_offer',[WebAdminController::class, 'UpdateOffer']);
        Route::post('update_feature',[WebAdminController::class, 'UpdateFeature']);
        Route::post('update_seo',[WebAdminController::class, 'UpdateSeo']);
        
        Route::get('happy_customer',[WebAdminController::class, 'HappyCustomer']);
        Route::get('add_customer',[WebAdminController::class, 'AddCustomer']);
        Route::post('post_customer',[WebAdminController::class, 'PostCustomer']);
        Route::get('edit_customer/{id}',[WebAdminController::class, 'EditCustomer']);
        Route::post('update_customer/{id}',[WebAdminController::class, 'UpdateCustomer']);
        Route::DELETE('delete_customer/{id}',[WebAdminController::class, 'DeleteCustomer']);
        
        Route::get('size',[WebAdminController::class, 'Size']);
        Route::get('add_size',[WebAdminController::class, 'AddSize']);
        Route::post('post_size',[WebAdminController::class, 'PostSize']);
        Route::DELETE('delete_size/{id}',[WebAdminController::class, 'DeleteSize']);
        
        Route::get('contact',[WebAdminController::class, 'Contact']);
        Route::post('contact_us/post',[WebAdminController::class, 'PostContactUs']);
        Route::get('user_quries',[WebAdminController::class, 'UserQuries']);
        Route::get('general',[WebAdminController::class, 'General']);
        Route::post('footer/post',[WebAdminController::class, 'PostFooter']);
        Route::get('get_size',[CatelogController::class, 'GetSize']);
        
        Route::resource('products',ProductController::class);
        
        Route::get('orders',[ProductController::class, 'orders']);
        Route::get('orders/{id}',[ProductController::class, 'orders_view']);
        
        Route::post('orders',[ProductController::class, 'orders_post']);
    });
});


