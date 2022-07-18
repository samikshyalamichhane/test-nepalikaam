<?php

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

use Illuminate\Support\Facades\Artisan;

Route::get('optimize-clear', function () {
    Artisan::call('optimize:clear');

    dd(Artisan::output());
});

Route::group(['namespace' => 'Admin'], function () {
    Route::get('admin-login', 'LoginController@login')->name('adminlogin');
    Route::match(['get', 'post'], 'postLogin', 'LoginController@postLogin')->name('postLogin');
    Route::get('password-reset', 'PasswordResetController@resetForm')->name('password-reset');
    Route::post('send-email-link', 'PasswordResetController@sendEmailLink')->name('sendEmailLink');
    Route::get('reset-password/{token}', 'PasswordResetController@passwordResetForm')->name('passwordResetForm');
    Route::post('update-password', 'PasswordResetController@updatePassword')->name('updatePassword');
});
Route::group(['namespace' => 'Admin', 'middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::resource('dashboard', 'DashboardController');
    Route::resource('rate', 'RateController');
    Route::get('change-rate','DashboardController@changeRate')->name('change-rate');
    Route::resource('promocode', 'PromocodeController');


    Route::post('changerate', 'DashboardController@storechangerate')->name('changerate.store');
    Route::post('update-transaction-status', 'DashboardController@updateTransactionStatus')->name('transactionStatus.update');

    Route::get('logout', 'LoginController@Logout')->name('logout');
    Route::group(['middleware' => ['admin']], function () {
        Route::resource('slider', 'SliderController');
        Route::resource('service', 'ServiceController');
        Route::resource('popupad', 'PopupadController');
        Route::group(['prefix' => 'slider'], function () {;
            Route::post('slider-process', 'SliderController@sliderProcess')->name('sliderProcess');
            Route::post('crop-modal', 'SliderController@cropmodal')->name('cropmodal');
            Route::post('crop-process', 'SliderController@cropprocess')->name('slidercropprocess');
            Route::post('update-slider/{id}', 'SliderController@updateSlider')->name('updateSlider');
        });
        Route::resource('testimonial', 'TestimonialController');
        Route::resource('user', 'UserController');

        Route::group(['prefix' => 'customer'], function () {
            Route::get('/add', 'CustomerController@customerAdd')->name('customerAdd');
            Route::post('save', 'CustomerController@saveCustomer')->name('saveCustomer');
            Route::get('approve-customer/{id}', 'CustomerController@approveCustomer')->name('approveCustomer');
            Route::get('reject-customer/{id}', 'CustomerController@rejectCustomer')->name('rejectCustomer');
            Route::get('approved-customer', 'CustomerController@approvedList')->name('approvedCustomer');
            Route::get('rejected-customer', 'CustomerController@rejectedList')->name('rejectedCustomer');
            Route::post('change-status', 'CustomerController@changeStatus')->name('changeStatus');
        });
        Route::resource('customer', 'CustomerController');
        Route::post('check-promocode', 'TransactionController@checkPromoCode')->name('admin.check.promocode');
        Route::get('transaction/daily-transaction', 'TransactionController@dailyTransaction')->name('dailyTransaction');
        Route::get('transaction/completed-transaction-report', 'TransactionController@completedTransactionReport')->name('completedTransactionReport');
        Route::get('{customerid}/allinfo/{type}', 'TransactionController@getReceiverInfo')->name('admin.getReceiverInfo');
        Route::resource('transaction', 'TransactionController');
        Route::post('/transaction/changeStatus', 'TransactionController@statusChange')->name('statusChange');
        Route::post('/transaction/search-transaction-with-dates', 'TransactionController@searchTransactionWithDates')->name('searchTransactionWithDates');
        Route::post('/transaction/search-transaction', 'TransactionController@searchTransaction')->name('searchTransaction');
        Route::get('/transaction-by-date/{date}', 'TransactionController@getByDate')->name('getByDate');
    });
});

Route::group(['namespace' => 'Front'], function () {
    Route::get('/', 'DefaultController@index')->name('home');
    Route::get('login', 'DefaultController@login')->name('login');
    Route::get('register', 'DefaultController@register')->name('register');
    Route::get('services', 'DefaultController@services')->name('services');
    Route::get('service/{slug}', 'DefaultController@serviceInner')->name('serviceInner');
    Route::get('contact-us', 'DefaultController@contactUs')->name('contactUs');
    Route::post('send-email', 'DefaultController@sendEmail')->name('sendEmail');
    Route::post('register', 'DefaultController@registerClient')->name('registerCLient');
    Route::get('track-remit', 'DefaultController@trackRemit')->name('trackRemit');
    Route::get('search-remit/{code}', 'DefaultController@searchRemit')->name('searchRemit');
    Route::get('tax', 'DefaultController@tax')->name('tax');
    Route::post('save-receiver', 'DefaultController@saveReceiver')->name('saveReceiver');
    Route::get('all-rates', 'DefaultController@getAllRates')->name('getAllRates');

    Route::group(['prefix' => 'client', 'middleware' => ['auth', 'client']], function () {
        Route::get('dashboard', 'DefaultController@clientDashboard')->name('clientDashboard');
        Route::get('make-transaction', 'DefaultController@makeTransaction')->name('makeTransaction');
        Route::get('all-transaction', 'DefaultController@allTransaction')->name('allTransaction');
        Route::get('view-profile/{id}', 'DefaultController@viewProfile')->name('viewProfile');
        Route::post('save-transaction', 'DefaultController@saveTransaction')->name('saveTransaction');
        Route::get('edit-profile/{id}', 'DefaultController@editProfile')->name('editProfile');
        Route::post('update-profile/{id}', 'DefaultController@updateProfile')->name('updateProfile');
        Route::get('logout', 'DefaultController@logOut')->name('clientLogOut');
        Route::get('allinfo/{type}', 'DefaultController@getReceiverInfo')->name('getReceiverInfo');
        Route::get('get-saveperson/{type}', 'DefaultController@getSavedPerson')->name('getSavedPerson');
        Route::resource('receiver', 'ReceiverController');
        Route::get('get-receiver', 'DefaultController@getAllReceivers')->name('getAllReceivers');
        Route::get('edit-receiver/{id}', 'DefaultController@editReceiver')->name('editReceiver');
        Route::put('update-receiver/{id}', 'DefaultController@updateReceiver')->name('updateReceiver');
        
        Route::get('bank-detail', 'DefaultController@getBankDetail')->name('get.bank-detail');
        Route::post('check-promocode', 'DefaultController@checkPromoCode')->name('check.promocode');

    });
});
