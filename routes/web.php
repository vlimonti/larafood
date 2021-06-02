<?php


Route::prefix('admin')
        ->namespace('Admin')
        ->middleware('auth')
        ->group(function() {
        
    /**
     * Route Product x Category
    */
    Route::get('products/{id}/category/{idCategory}/detach', 'CategoryProductController@detachCategoryProduct')->name('product.category.detach');
    Route::post('products/{id}/categories', 'CategoryProductController@attachCategoriesProduct')->name('products.categories.attach');
    Route::any('products/{id}/categories/create', 'CategoryProductController@categoriesAvailable')->name('products.categories.available');
    Route::get('products/{id}/categories', 'CategoryProductController@categories')->name('products.categories');
    Route::get('categories/{id}/products', 'CategoryProductController@products')->name('categories.products');
    

    /**
    * Route Products
    */
    Route::any('products/search', 'ProductController@search')->name('products.search');
    Route::resource('products', 'ProductController');


    /**
    * Route Categories
    */
    Route::any('categories/search', 'CategoryController@search')->name('categories.search');
    Route::resource('categories', 'CategoryController');

    /**
    * Route Users
    */
    Route::any('users/search', 'UserController@search')->name('users.search');
    Route::resource('users', 'UserController');

    /**
     * Route Plan x Profile
    */
    Route::get('plans/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachPlanProfile')->name('plan.profile.detach');
    Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@attachPlansProfile')->name('plans.profiles.attach');
    Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
    Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');
    Route::get('profiles/{id}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');
    
    /**
     * Route Permission x Profile
    */
    Route::get('permissions/{idPermission}/profiles/{idProfile}/detach', 'ACL\PermissionProfileController@detachProfilePermission')->name('permission.profile.detach');
    Route::post('permissions/{idPermission}/profiles', 'ACL\PermissionProfileController@attachProfilesPermission')->name('permission.profiles.attach');
    Route::any('permissions/{idPermission}/profiles/create', 'ACL\PermissionProfileController@profilesAvailable')->name('permission.profiles.available');
    Route::get('permissions/{idPermission}/profiles', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');
    
    Route::get('profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionProfile')->name('profiles.permission.detach');
    Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
    
    /**
     * Route Permissions
    */
    Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
    Route::resource('permissions', 'ACL\PermissionController');

    /**
     * Route Profiles
    */
    Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ACL\ProfileController');

    /**
     * Route Details Plans
    */
    Route::delete('plans/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
    Route::get('plans/{url}/details/{idDetail}/s', 'DetailPlanController@show')->name('details.plan.show');
    Route::put('plans/{url}/details/{idDetail}', 'DetailPlanController@update')->name('details.plan.update');
    Route::get('plans/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
    Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');

    /**
     * Route Plans
    */
    Route::get('plans/create', 'PlanController@create')->name('plans.create');
    Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    Route::any('plans/search', 'PlanController@search')->name('plans.search');
    Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
    Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
    Route::post('plans', 'PlanController@store')->name('plans.store');
    Route::get('plans', 'PlanController@index')->name('plans.index');
    
    /**
     * Route Dashboard
    */
    Route::get('/', 'PlanController@index')->name('admin.index');
});


/**
 * Site
 */
Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');


/**
 * Auth Routes
 */
Auth::routes();