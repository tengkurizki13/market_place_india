<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){

    // admin login Route without admin group
    Route::match(['get','post'],'login',"AdminController@login");
    Route::group(['middleware'=> ['admin']],function(){
        // Admin Dashboard Route without admin group
        Route::get('dashboard',"AdminController@dashboard");
        
        // update admin password
        Route::match(['get','post'],'update-admin-password',"AdminController@updateAdminPassword");

        // Check admin password
        Route::post('check-admin-password',"AdminController@checkAdminPassword");

          // update admin details
          Route::match(['get','post'],'update-admin-details',"AdminController@updateAdminDetails");

          // update vendor details
          Route::match(['get','post'],'update-vendor-details/{slug}',"AdminController@updateVendorDetails");

        // View Admins/ SubAdmins / Vendors 
        Route::get('admins/{type?}',"AdminController@admins");

        // View Vendor Details 
        Route::get('view-vendor-details/{id}',"AdminController@viewVendorDetails");

        // Update Admin Status 
        Route::post('update-admin-status',"AdminController@updateAdminStatus");

        // admin logout
        Route::get('logout',"AdminController@logout");


        // Sections
        Route::get('sections',"SectionController@sections");

         // Update Sections Status 
         Route::post('update-section-status',"SectionController@updateSectionStatus");
        
         // Delete Sections
        Route::get('delete-section/{id}',"SectionController@deleteSection");

         // Add sections
         Route::match(['get','post'],'add-edit-section/{id?}',"SectionController@addEditSection");

         // Catagories
        Route::get('catagories',"CatagoryController@catagories");

        // Update Catagories Status 
        Route::post('update-catagory-status',"CatagoryController@updateCatagoryStatus");

          // Add Catagories
          Route::match(['get','post'],'add-edit-catagory/{id?}',"CatagoryController@addEditCatagory");

        // appedn Catagories level
        Route::get('append-catagories-level',"CatagoryController@appendCatagoryLevel");
    });
});

