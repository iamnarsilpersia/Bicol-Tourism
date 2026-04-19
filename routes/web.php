<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/tourist-spots', [HomeController::class, 'touristSpots'])->name('public.tourist-spots');
Route::get('/tourist-spots/{id}', [HomeController::class, 'touristSpotDetail'])->name('public.tourist-spot-detail');
Route::get('/tour-packages', [HomeController::class, 'tourPackages'])->name('public.tour-packages');
Route::get('/map', [HomeController::class, 'map'])->name('public.map');
Route::get('/nearby-places', [HomeController::class, 'nearbyPlaces'])->name('public.nearby-places');
Route::get('/book-tour', [BookingController::class, 'createTour'])->name('public.book-tour')->middleware('auth');
Route::post('/book-tour', [BookingController::class, 'storeTour'])->name('public.book-tour.store')->middleware('auth');

Route::get('/public/tour-packages', [HomeController::class, 'tourPackages'])->name('public.tour-packages');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/tourist-spots', [AdminController::class, 'touristSpots'])->name('tourist-spots');
    Route::get('/tourist-spots/create', [AdminController::class, 'createTouristSpot'])->name('tourist-spots.create');
    Route::post('/tourist-spots', [AdminController::class, 'storeTouristSpot'])->name('tourist-spots.store');
    Route::get('/tourist-spots/{id}/edit', [AdminController::class, 'editTouristSpot'])->name('tourist-spots.edit');
    Route::put('/tourist-spots/{id}', [AdminController::class, 'updateTouristSpot'])->name('tourist-spots.update');
    Route::delete('/tourist-spots/{id}', [AdminController::class, 'destroyTouristSpot'])->name('tourist-spots.destroy');
    
    Route::get('/tour-packages', [AdminController::class, 'tourPackages'])->name('tour-packages');
    Route::get('/tour-packages/create', [AdminController::class, 'createTourPackage'])->name('tour-packages.create');
    Route::post('/tour-packages', [AdminController::class, 'storeTourPackage'])->name('tour-packages.store');
    Route::get('/tour-packages/{id}/edit', [AdminController::class, 'editTourPackage'])->name('tour-packages.edit');
    Route::put('/tour-packages/{id}', [AdminController::class, 'updateTourPackage'])->name('tour-packages.update');
    Route::delete('/tour-packages/{id}', [AdminController::class, 'destroyTourPackage'])->name('tour-packages.destroy');
    
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('reservations');
    Route::post('/reservations/{id}/status', [AdminController::class, 'updateReservationStatus'])->name('reservations.update-status');
    
    Route::get('/tour-guides', [AdminController::class, 'tourGuides'])->name('tour-guides');
    Route::get('/tour-guides/create', [AdminController::class, 'createTourGuide'])->name('tour-guides.create');
    Route::post('/tour-guides', [AdminController::class, 'storeTourGuide'])->name('tour-guides.store');
    Route::get('/tour-guides/{id}/edit', [AdminController::class, 'editTourGuide'])->name('tour-guides.edit');
    Route::put('/tour-guides/{id}', [AdminController::class, 'updateTourGuide'])->name('tour-guides.update');
    Route::delete('/tour-guides/{id}', [AdminController::class, 'destroyTourGuide'])->name('tour-guides.destroy');
    
    Route::get('/tour-guide-bookings', [AdminController::class, 'tourGuideBookings'])->name('tour-guide-bookings');
    Route::post('/tour-guide-bookings/{id}/status', [AdminController::class, 'updateTourGuideBookingStatus'])->name('tour-guide-bookings.update-status');
    
    Route::get('/hotels', [AdminController::class, 'hotels'])->name('hotels');
    Route::get('/hotels/create', [AdminController::class, 'createHotel'])->name('hotels.create');
    Route::post('/hotels', [AdminController::class, 'storeHotel'])->name('hotels.store');
    Route::get('/hotels/{id}/edit', [AdminController::class, 'editHotel'])->name('hotels.edit');
    Route::put('/hotels/{id}', [AdminController::class, 'updateHotel'])->name('hotels.update');
    Route::delete('/hotels/{id}', [AdminController::class, 'destroyHotel'])->name('hotels.destroy');
    
    Route::get('/shops', [AdminController::class, 'shops'])->name('shops');
    Route::get('/shops/create', [AdminController::class, 'createShop'])->name('shops.create');
    Route::post('/shops', [AdminController::class, 'storeShop'])->name('shops.store');
    Route::get('/shops/{id}/edit', [AdminController::class, 'editShop'])->name('shops.edit');
    Route::put('/shops/{id}', [AdminController::class, 'updateShop'])->name('shops.update');
    Route::delete('/shops/{id}', [AdminController::class, 'destroyShop'])->name('shops.destroy');
    
    Route::get('/souvenirs', [AdminController::class, 'souvenirs'])->name('souvenirs');
    Route::get('/souvenirs/create', [AdminController::class, 'createSouvenir'])->name('souvenirs.create');
    Route::post('/souvenirs', [AdminController::class, 'storeSouvenir'])->name('souvenirs.store');
    
    Route::get('/restaurants', [AdminController::class, 'restaurants'])->name('restaurants');
    Route::get('/restaurants/create', [AdminController::class, 'createRestaurant'])->name('restaurants.create');
    Route::post('/restaurants', [AdminController::class, 'storeRestaurant'])->name('restaurants.store');
    Route::get('/restaurants/{id}/edit', [AdminController::class, 'editRestaurant'])->name('restaurants.edit');
    Route::put('/restaurants/{id}', [AdminController::class, 'updateRestaurant'])->name('restaurants.update');
    Route::delete('/restaurants/{id}', [AdminController::class, 'destroyRestaurant'])->name('restaurants.destroy');
    
    Route::get('/custom-tours', [AdminController::class, 'customTours'])->name('custom-tours');
    Route::post('/custom-tours/{id}/status', [AdminController::class, 'updateCustomTourStatus'])->name('custom-tours.update-status');
    
    Route::get('/appointments', [AdminController::class, 'appointments'])->name('appointments');
    Route::post('/appointments/{id}/status', [AdminController::class, 'updateAppointmentStatus'])->name('appointments.update-status');
    
    Route::get('/map', [AdminController::class, 'mapView'])->name('map');
    Route::get('/nearby-places', [AdminController::class, 'nearbyPlaces'])->name('nearby-places');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/tourist-spots', [UserController::class, 'touristSpots'])->name('tourist-spots');
    
    Route::get('/tour-packages', [UserController::class, 'tourPackages'])->name('tour-packages');
    Route::get('/tour-packages/{id}/book', [UserController::class, 'bookPackage'])->name('book-package');
    Route::post('/reservations', [UserController::class, 'storeReservation'])->name('reservations.store');
    Route::post('/reservations/{id}/cancel', [UserController::class, 'cancelReservation'])->name('reservations.cancel');
    
    Route::get('/tour-guides', [UserController::class, 'tourGuides'])->name('tour-guides');
    Route::get('/tour-guides/{id}/book', [UserController::class, 'bookTourGuide'])->name('book-tour-guide');
    Route::post('/tour-guide-bookings', [UserController::class, 'storeTourGuideBooking'])->name('tour-guide-bookings.store');
    Route::post('/tour-guide-bookings/{id}/cancel', [UserController::class, 'cancelGuideBooking'])->name('tour-guide-bookings.cancel');
    
    Route::get('/appointments', [UserController::class, 'appointments'])->name('appointments.index');
    Route::get('/appointments/create', [UserController::class, 'createAppointment'])->name('appointments.create');
    Route::post('/appointments', [UserController::class, 'storeAppointment'])->name('appointments.store');
    Route::post('/appointments/{id}/cancel', [UserController::class, 'cancelAppointment'])->name('appointments.cancel');
    
    Route::get('/nearby-places', [UserController::class, 'nearbyPlaces'])->name('nearby-places');
    Route::get('/nearby-places/form', function() { return view('user.nearby-places', ['hotels' => collect(), 'shops' => collect()]); })->name('nearby-places-form');
    
    Route::get('/map', [UserController::class, 'mapView'])->name('map');
    
    Route::post('/custom-tours/{id}/cancel', [UserController::class, 'cancelCustomTour'])->name('custom-tours.cancel');
});
