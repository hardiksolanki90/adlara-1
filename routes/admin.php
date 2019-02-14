<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('challenge'));
});
Route::group(['middleware' => 'admin'], function () {
				// @AdminUserController routes@ Added from component controller
				Route::get('admin/user/add', 'AdminUserController@initContentCreate')->name('admin_user.add');
				Route::post('admin/user/add', 'AdminUserController@initProcessCreate');
				Route::get('admin/user/edit/{id}', 'AdminUserController@initContentCreate')->name('admin_user.edit');
				Route::post('admin/user/edit/{id}', 'AdminUserController@initProcessCreate');
				Route::get('admin/user', 'AdminUserController@initListing')->name('admin_user.list');
				Route::get('admin/user/delete/{id}', 'AdminUserController@initProcessDelete')->name('admin_user.delete');

				Route::get('product/add', 'ProductController@initContentCreate')->name('product.add');
				Route::post('product/add', 'ProductController@initProcessCreate');
				Route::get('product/edit/{id}', 'ProductController@initContentCreate')->name('product.edit');
				Route::post('product/edit/{id}', 'ProductController@initProcessCreate');
				Route::get('product', 'ProductController@initListing')->name('product.list');
				Route::get('product/delete/{id}', 'ProductController@initProcessDelete')->name('product.delete');

				Route::get('product/category/assigned', 'ProductCategoryAssignedController@initListing')->name('product_category_assigned.list');

				Route::get('product/category/add', 'ProductCategoryController@initContentCreate')->name('product_category.add');
				Route::post('product/category/add', 'ProductCategoryController@initProcessCreate');
				Route::get('product/category/edit/{id}', 'ProductCategoryController@initContentCreate')->name('product_category.edit');
				Route::post('product/category/edit/{id}', 'ProductCategoryController@initProcessCreate');
				Route::get('product/category', 'ProductCategoryController@initListing')->name('product_category.list');
				Route::get('product/category/delete/{id}', 'ProductCategoryController@initProcessDelete')->name('product_category.delete');

				Route::get('admin/user/add', 'AdminUserController@initContentCreate')->name('admin_user.add');
				Route::post('admin/user/add', 'AdminUserController@initProcessCreate');
				Route::get('admin/user/edit/{id}', 'AdminUserController@initContentCreate')->name('admin_user.edit');
				Route::post('admin/user/edit/{id}', 'AdminUserController@initProcessCreate');
				Route::get('admin/user', 'AdminUserController@initListing')->name('admin_user.list');
				Route::get('admin/user/delete/{id}', 'AdminUserController@initProcessDelete')->name('admin_user.delete');

				Route::get('product/add', 'ProductController@initContentCreate')->name('product.add');
				Route::post('product/add', 'ProductController@initProcessCreate');
				Route::get('product/edit/{id}', 'ProductController@initContentCreate')->name('product.edit');
				Route::post('product/edit/{id}', 'ProductController@initProcessCreate');
				Route::get('product', 'ProductController@initListing')->name('product.list');
				Route::get('product/delete/{id}', 'ProductController@initProcessDelete')->name('product.delete');

				Route::get('post/add', 'PostController@initContentCreate')->name('post.add');
				Route::post('post/add', 'PostController@initProcessCreate');
				Route::get('post/edit/{id}', 'PostController@initContentCreate')->name('post.edit');
				Route::post('post/edit/{id}', 'PostController@initProcessCreate');
				Route::get('post', 'PostController@initListing')->name('post.list');
				Route::get('post/delete/{id}', 'PostController@initProcessDelete')->name('post.delete');

				Route::get('post/category/add', 'PostCategoryController@initContentCreate')->name('post_category.add');
				Route::post('post/category/add', 'PostCategoryController@initProcessCreate');
				Route::get('post/category/edit/{id}', 'PostCategoryController@initContentCreate')->name('post_category.edit');
				Route::post('post/category/edit/{id}', 'PostCategoryController@initProcessCreate');
				Route::get('post/category', 'PostCategoryController@initListing')->name('post_category.list');
				Route::get('post/category/delete/{id}', 'PostCategoryController@initProcessDelete')->name('post_category.delete');

				Route::get('post/add', 'PostController@initContentCreate')->name('post.add');
				Route::post('post/add', 'PostController@initProcessCreate');
				Route::get('post/edit/{id}', 'PostController@initContentCreate')->name('post.edit');
				Route::post('post/edit/{id}', 'PostController@initProcessCreate');
				Route::get('post', 'PostController@initListing')->name('post.list');
				Route::get('post/delete/{id}', 'PostController@initProcessDelete')->name('post.delete');

				Route::get('post/tags/add', 'PostTagsController@initContentCreate')->name('post_tags.add');
				Route::post('post/tags/add', 'PostTagsController@initProcessCreate');
				Route::get('post/tags/edit/{id}', 'PostTagsController@initContentCreate')->name('post_tags.edit');
				Route::post('post/tags/edit/{id}', 'PostTagsController@initProcessCreate');
				Route::get('post/tags', 'PostTagsController@initListing')->name('post_tags.list');
				Route::get('post/tags/delete/{id}', 'PostTagsController@initProcessDelete')->name('post_tags.delete');

				Route::get('post/category/add', 'PostCategoryController@initContentCreate')->name('post_category.add');
				Route::post('post/category/add', 'PostCategoryController@initProcessCreate');
				Route::get('post/category/edit/{id}', 'PostCategoryController@initContentCreate')->name('post_category.edit');
				Route::post('post/category/edit/{id}', 'PostCategoryController@initProcessCreate');
				Route::get('post/category', 'PostCategoryController@initListing')->name('post_category.list');
				Route::get('post/category/delete/{id}', 'PostCategoryController@initProcessDelete')->name('post_category.delete');

				Route::get('performance/dates/add', 'PerformanceDatesController@initContentCreate')->name('performance_dates.add');
				Route::post('performance/dates/add', 'PerformanceDatesController@initProcessCreate');
				Route::get('performance/dates/edit/{id}', 'PerformanceDatesController@initContentCreate')->name('performance_dates.edit');
				Route::post('performance/dates/edit/{id}', 'PerformanceDatesController@initProcessCreate');

				Route::get('media/test/add', 'MediaTestController@initContentCreate')->name('media_test.add');
				Route::post('media/test/add', 'MediaTestController@initProcessCreate');
				Route::get('media/test/edit/{id}', 'MediaTestController@initContentCreate')->name('media_test.edit');
				Route::post('media/test/edit/{id}', 'MediaTestController@initProcessCreate');
				Route::get('media/test', 'MediaTestController@initListing')->name('media_test.list');
				Route::get('media/test/delete/{id}', 'MediaTestController@initProcessDelete')->name('media_test.delete');

        Route::any('media/get/list', 'MediaController@initListingPartial');
        // @MediaController routes@ Added from component controller
				Route::post('media/add/embeded', 'MediaController@initProcessEmbed')->name('media.add.embeded');
				Route::get('media/add', 'MediaController@initContentCreate')->name('media.add');
				Route::post('media/add', 'MediaController@initProcessCreate');
				Route::get('media/edit/{id}', 'MediaController@initContentCreate')->name('media.edit');
				Route::post('media/edit/{id}', 'MediaController@initProcessCreate');
				Route::get('media', 'MediaController@initListing')->name('media.list');
				Route::get('media/delete/{id}', 'MediaController@initProcessDelete')->name('media.delete');

				Route::get('media/add', 'MediaController@initContentCreate')->name('media.add');
				Route::post('media/add', 'MediaController@initProcessCreate');
				Route::post('media/upload', 'MediaController@initProcessUpload')->name('media.upload');
				Route::get('media/edit/{id}', 'MediaController@initContentCreate')->name('media.edit');
				Route::post('media/edit/{id}', 'MediaController@initProcessCreate');
				Route::get('media', 'MediaController@initListing')->name('media.list');
				Route::get('media/delete/{id}', 'MediaController@initProcessDelete')->name('media.delete');

        Route::get('configuration', 'ConfigurationController@initContentCreate')->name('configuration');
        Route::post('configuration', 'ConfigurationController@initProcessCreate');

        Route::get('flush/cache', function () {
          cache()->flush();
          session()->flash('flash', [
            'status' => 'success',
            'message' => 'Cache cleared successfully'
          ])->name('flush.cache');
          return redirect(url()->previous());
        });

        Route::get('reset/assets', 'ConfigurationController@initProcessResetAssets')->name('reset.assets');

    // Route::get('configure', function () {
    //   return 'configuration';
    // })->name('configuration');

				// @AdminMenuChildController routes@ Added from component controller
				Route::get('admin/menu/child/add', 'AdminMenuChildController@initContentCreate')->name('admin_menu_child.add');
				Route::post('admin/menu/child/add', 'AdminMenuChildController@initProcessCreate');
				Route::get('admin/menu/child/edit/{id}', 'AdminMenuChildController@initContentCreate')->name('admin_menu_child.edit');
				Route::post('admin/menu/child/edit/{id}', 'AdminMenuChildController@initProcessCreate');
				Route::get('admin/menu/child', 'AdminMenuChildController@initListing')->name('admin_menu_child.list');
				Route::get('admin/menu/child/delete/{id}', 'AdminMenuChildController@initProcessDelete')->name('admin_menu_child.delete');

				Route::get('admin/menu/add', 'AdminMenuController@initContentCreate')->name('admin_menu.add');
				Route::post('admin/menu/add', 'AdminMenuController@initProcessCreate');
				Route::get('admin/menu/edit/{id}', 'AdminMenuController@initContentCreate')->name('admin_menu.edit');
				Route::post('admin/menu/edit/{id}', 'AdminMenuController@initProcessCreate');
				Route::get('admin/menu', 'AdminMenuController@initListing')->name('admin_menu.list');
				Route::get('admin/menu/delete/{id}', 'AdminMenuController@initProcessDelete')->name('admin_menu.delete');

				Route::get('admin/menu/headings/add', 'MenuHeadingController@initContentCreate')->name('menu_heading.add');
				Route::post('admin/menu/headings/add', 'MenuHeadingController@initProcessCreate');
				Route::get('admin/menu/headings/edit/{id}', 'MenuHeadingController@initContentCreate')->name('menu_heading.edit');
				Route::post('admin/menu/headings/edit/{id}', 'MenuHeadingController@initProcessCreate');
				Route::get('admin/menu/headings', 'MenuHeadingController@initListing')->name('menu_heading.list');
				Route::get('admin/menu/headings/delete/{id}', 'MenuHeadingController@initProcessDelete')->name('menu_heading.delete');

				Route::get('theatre-owner/add', 'TheatreOwnerController@initContentCreate')->name('theatre_owner.add');
				Route::post('theatre-owner/add', 'TheatreOwnerController@initProcessCreate');
				Route::get('theatre-owner/edit/{id}', 'TheatreOwnerController@initContentCreate')->name('theatre_owner.edit');
				Route::post('theatre-owner/edit/{id}', 'TheatreOwnerController@initProcessCreate');
				Route::get('theatre-owner', 'TheatreOwnerController@initListing')->name('theatre_owner.list');
				Route::get('theatre-owner/delete/{id}', 'TheatreOwnerController@initProcessDelete')->name('theatre_owner.delete');

				Route::get('country/add', 'CountriesController@initContentCreate');
				Route::post('country/add', 'CountriesController@initProcessCreate');
				Route::get('country/edit/{id}', 'CountriesController@initContentCreate');
				Route::post('country/edit/{id}', 'CountriesController@initProcessCreate');
				Route::get('country', 'CountriesController@initListing');
				Route::get('country/delete/{id}', 'AdminControllers@initProcessDelete');


		// @PageController routes@ Added from component controller
		Route::get('page/add', 'PageController@initContentCreate')->name('page.add');
		Route::post('page/add', 'PageController@initProcessCreate');
		Route::get('page/edit/{id}', 'PageController@initContentCreate');
		Route::post('page/edit/{id}', 'PageController@initProcessCreate');
		Route::get('page', 'PageController@initListing')->name('page.list');
		Route::get('page/delete/{id}', 'AdminControllers@initProcessDelete')->name('page.delete');

    Route::get('block/add', 'BlockController@initContentCreate')->name('block.add');
    Route::post('block/add', 'BlockController@initProcessCreate');
    Route::get('block/edit/{id}', 'BlockController@initContentCreate');
    Route::post('block/edit/{id}', 'BlockController@initProcessCreate');
    Route::get('block', 'BlockController@initListing')->name('block.list');
    Route::get('block/delete/{id}', 'AdminControllers@initProcessDelete')->name('block.delete');

    Route::get('dashboard', 'DashboardController@initContent')->name('dashboard');
    Route::get('dashboard/live/users', 'DashboardController@initProcessGetLiveUsers')->name('dashboard.live.users');
    Route::get('dashboard/top/os', 'DashboardController@initProcessTopOS')->name('dashboard.top.os');
    Route::get('dashboard/daily/visits', 'DashboardController@initProcessDailyVisits')->name('dashboard.daily.visits');
    Route::get('logout', 'EmployeeController@initProcessLogout')->name('employee.logout');
});
Route::group(['prefix' => 'employee'], function () {
    Route::get('register', 'EmployeeController@initContentRegister')->name('employee.register');
    Route::post('register', 'EmployeeController@initProcessRegister');
});
Route::get('secure/challenge', 'AdminAuthController@initContent')->name('challenge');
Route::post('secure/challenge', 'AdminAuthController@initProcessLogin');
