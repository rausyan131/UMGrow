<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Livewire\Product\Show;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Umkm\Detail;
use App\Livewire\Collaboration\SentRequestDetail;
use App\Livewire\Collaboration\ReceivedRequestDetail;
use App\Livewire\Collaboration\CollaborationTabs;
use App\Livewire\Collaboration\DetailCollaboration;




// Route Home Page
Route::get('/', function () {
    return view('index'); 
});

Route::middleware('guest')->group(function () {
// Route autentikasi
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');
});



Route::middleware('auth')->group(function () {

    Route::view('/complete-profile', 'umkm-profile.complete-profile')->name('complete-profile');
    Route::view('/dashboard', 'dashboard.index')->name('dashboard');

    //umkm profile 
    Route::view('/profile/detail-umkm', 'umkm-profile.detail-umkm')->name('profile.detail-umkm');
    Route::view('/profile/edit', 'umkm-profile.edit-umkm-profile')->name('profile.edit');

    // kolaborasi
    Route::get('/kolaborasi', CollaborationTabs::class)->name('collaboration');
    Route::get('/kolaborasi/detail/{id}', DetailCollaboration::class)
    ->name('collaboration.detail');

    // kolaborasi paket bundling







   
    

    Route::get('/kolaborasi/sent-request/{id}', SentRequestDetail::class)->name('collaboration.sent-request.detail');
    Route::get('/kolaborasi/received-request/{id}', ReceivedRequestDetail::class)->name('collaboration.received-request.detail');
    


    // produk
    Route::view('/umkm/product', 'product.index')->name('umkm.products');
    Route::get('/produk/{product}', Show::class)->name('product.detail');

    // umkm
    Route::view('/umkm/umkm-list', 'umkm.index')->name('umkm.umkm-list');
    Route::get('/umkm/{id}', Detail::class)->name('umkm.detail');











    // Route logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
    

});
