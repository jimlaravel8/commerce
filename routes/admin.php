<?php

    Route::GET('/home', '\App\Http\Controllers\admin\AdminController@index')->name('admin.home');
    // Login and Logout
    Route::GET('/', 'LoginController@showLoginForm')->name('admin.login');
    Route::POST('/', 'LoginController@login');
    Route::POST('/logout', 'LoginController@logout')->name('admin.logout');

    // Password Resets
    Route::POST('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::GET('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::POST('/password/reset', 'ResetPasswordController@reset');
    Route::GET('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::GET('/password/change', 'AdminController@showChangePasswordForm')->name('admin.password.change');
    Route::POST('/password/change', 'AdminController@changePassword');

    // Register Admins
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'RegisterController@register');
    Route::get('/{admin}/edit', 'RegisterController@edit')->name('admin.edit');
    Route::delete('/{admin}', 'RegisterController@destroy')->name('admin.delete');
    Route::patch('/{admin}', 'RegisterController@update')->name('admin.update');

    // Admin Lists
    Route::get('/show', 'AdminController@show')->name('admin.show');
    Route::get('/me', 'AdminController@me')->name('admin.me');

    // Admin Roles
    Route::post('/{admin}/role/{role}', 'AdminRoleController@attach')->name('admin.attach.roles');
    Route::delete('/{admin}/role/{role}', 'AdminRoleController@detach');

    // Roles
    Route::get('/roles', 'RoleController@index')->name('admin.roles');
    Route::get('/role/create', 'RoleController@create')->name('admin.role.create');
    Route::post('/role/store', 'RoleController@store')->name('admin.role.store');
    Route::delete('/role/{role}', 'RoleController@destroy')->name('admin.role.delete');
    Route::get('/role/{role}/edit', 'RoleController@edit')->name('admin.role.edit');
    Route::patch('/role/{role}', 'RoleController@update')->name('admin.role.update');

    // active status
    Route::post('activation/{admin}', 'ActivationController@activate')->name('admin.activation');
    Route::delete('activation/{admin}', 'ActivationController@deactivate');
    Route::resource('permission', 'PermissionController');

    Route::fallback(function () {
        return abort(404);
    });






    // Route::group(['middleware' => ['authcheck']], function () {
        // Route::get('/', 'HomeController@index')->name('home');
        Route::resource('users', '\App\Http\Controllers\admin\UserController');
        Route::resource('roles', '\App\Http\Controllers\admin\RoleController');
        Route::resource('products', '\App\Http\Controllers\admin\ProductController');
        Route::resource('sales', '\App\Http\Controllers\admin\SaleController');
        Route::resource('clients', '\App\Http\Controllers\admin\ClientController');
        Route::resource('groups', '\App\Http\Controllers\admin\GroupController');
        Route::resource('drawers', '\App\Http\Controllers\admin\DrawerController');
        Route::resource('discounts', '\App\Http\Controllers\admin\OfferController');
        Route::resource('variants', '\App\Http\Controllers\admin\VariantController');
        Route::resource('sku', '\App\Http\Controllers\admin\SkuController');
        Route::resource('menu', '\App\Http\Controllers\admin\MenuController');
        Route::resource('categories', '\App\Http\Controllers\admin\CategoryController');
        Route::resource('subcategories', '\App\Http\Controllers\admin\SubcategoryController');
        Route::resource('brands', '\App\Http\Controllers\admin\BrandController');
        Route::resource('images', '\App\Http\Controllers\admin\ImageController');
        Route::resource('slider', '\App\Http\Controllers\admin\SliderController');
        Route::resource('currencies', '\App\Http\Controllers\admin\CurrencyController');
        Route::resource('order_address', '\App\Http\Controllers\admin\OrdershippingController');
        Route::resource('statuses', '\App\Http\Controllers\admin\StatusController');
        Route::resource('withdrawals', '\App\Http\Controllers\admin\WithdrawController');
        Route::resource('product_options', '\App\Http\Controllers\admin\OptionController');


        Route::post('status_update/{id}', '\App\Http\Controllers\admin\StatusController@status_update')->name('status_update');


        Route::post('filter_withdrawals', '\App\Http\Controllers\admin\WithdrawController@filter_withdrawals')->name('filter_withdrawals');


        Route::post('images/{id}', '\App\Http\Controllers\admin\ImageController@images')->name('images');
        Route::post('product_image/{id}', '\App\Http\Controllers\admin\ImageController@product_image')->name('product_image');

        Route::get('product_search/{search}', '\App\Http\Controllers\admin\ProductController@product_search')->name('product_search');

        Route::get('client_search/{search}', '\App\Http\Controllers\admin\ClientController@client_search')->name('client_search');

        Route::get('product_table', '\App\Http\Controllers\admin\ProductController@product_table')->name('product_table');

        Route::get('options', '\App\Http\Controllers\admin\VariantController@options')->name('options');
        Route::get('option_values', '\App\Http\Controllers\admin\VariantController@option_values')->name('option_values');
        Route::get('product_variant/{id}', '\App\Http\Controllers\admin\VariantController@product_variant')->name('product_variant');
        Route::get('variant_sku/{id}', '\App\Http\Controllers\admin\VariantController@variant_sku')->name('variant_sku');

        Route::post('variants_values/{id}', '\App\Http\Controllers\admin\SkuController@variants_values')->name('variants_values');

        Route::get('unique_sku/{id}', '\App\Http\Controllers\admin\AutoGenerateController@unique_sku')->name('unique_sku');

        Route::get('permissions', '\App\Http\Controllers\admin\RoleController@permissions')->name('permissions');
        Route::post('getRolesPerm/{id}', '\App\Http\Controllers\admin\RoleController@getRolesPerm')->name('getRolesPerm');


        Route::post('getUserPerm/{id}', '\App\Http\Controllers\admin\UserController@getUserPerm')->name('getUserPerm');
        Route::post('permisions/{id}', '\App\Http\Controllers\admin\UserController@permisions')->name('permisions');
        Route::patch('undeletedUser/{id}', '\App\Http\Controllers\admin\UserController@undeletedUser')->name('undeletedUser');
        Route::delete('force_user/{id}', '\App\Http\Controllers\admin\UserController@force_user')->name('force_user');
        Route::get('deletedUsers', '\App\Http\Controllers\admin\UserController@deletedUsers')->name('deletedUsers');


        Route::post('featured', '\App\Http\Controllers\admin\ProductSettingsController@featured')->name('featured');
        Route::post('newproduct', '\App\Http\Controllers\admin\ProductSettingsController@newproduct')->name('newproduct');
        Route::post('bestsellers', '\App\Http\Controllers\admin\ProductSettingsController@bestsellers')->name('bestsellers');


        Route::post('product_settings', '\App\Http\Controllers\admin\ProductSettingsController@product_settings')->name('product_settings');



        // Dashboard
        Route::any('user_count', '\App\Http\Controllers\admin\DashboardController@user_count')->name('user_count');
        Route::any('clients_count', '\App\Http\Controllers\admin\DashboardController@clients_count')->name('clients_count');
        Route::any('week_sales_count', '\App\Http\Controllers\admin\DashboardController@week_sales_count')->name('week_sales_count');
        Route::any('sellers_count', '\App\Http\Controllers\admin\DashboardController@sellers_count')->name('sellers_count');
        Route::any('total_sales_count', '\App\Http\Controllers\admin\DashboardController@total_sales_count')->name('total_sales_count');

        // Charts
        Route::any('clients_chart', '\App\Http\Controllers\admin\DashboardController@clients_chart')->name('clients_chart');
        Route::any('sellers_chart', '\App\Http\Controllers\admin\DashboardController@sellers_chart')->name('sellers_chart');
        Route::any('sales_chart', '\App\Http\Controllers\admin\DashboardController@sales_chart')->name('sales_chart');

        Route::any('product_count', '\App\Http\Controllers\admin\DashboardController@product_count')->name('product_count');
        Route::any('category_count', '\App\Http\Controllers\admin\DashboardController@category_count')->name('category_count');
        Route::any('brand_count', '\App\Http\Controllers\admin\DashboardController@brand_count')->name('brand_count');

        // Seller Dashboard
        Route::any('week_total_sales_income', '\App\Http\Controllers\admin\DashboardController@week_total_sales_income')->name('week_total_sales_income');
        Route::any('week_sold_items', '\App\Http\Controllers\admin\DashboardController@week_sold_items')->name('week_sold_items');
        Route::any('week_orders', '\App\Http\Controllers\admin\DashboardController@week_orders')->name('week_orders');


