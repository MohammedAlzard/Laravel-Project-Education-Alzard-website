<?php

// For In order to determine the input through the router
Route::pattern('id', '[0-9]+');
Route::pattern('category', '[0-9]+');
Route::pattern('post', '[0-9]+');

Route::group(['middleware' => 'guest'], function() {

    Route::get('login', 'AdminAuth@login');
	Route::post('login', 'AdminAuth@dologin');
	Route::get('register', 'AdminAuth@register');
	Route::post('register', 'AdminAuth@doregister');

	// For Login With Socialite
	Route::get('login/{provider}', 'ProviderSocialiteController@redirectToProvider');
	Route::get('login/{provider}/callback', 'ProviderSocialiteController@handleProviderCallback');
});

	Route::get('confirmation/{token}', 'AdminAuth@confirmation');
	Route::post('confirmation/{token}', 'AdminAuth@confirmation_post');

	Route::get('forgot/password', 'AdminAuth@forgot_password');
	Route::post('forgot/password', 'AdminAuth@forgot_password_post');
	Route::get('reset/password/{token}', 'AdminAuth@reset_password');
	Route::post('reset/password/{token}', 'AdminAuth@reset_password_post');


Route::group(['prefix' => 'admin'], function () {

	Route::group(['middleware' => ['roles'], 'roles' => ['admin', 'Editor']], function () {
    

	    Route::get('/', 'DashboardController@index');
	    Route::get('/get-message', 'DashboardController@get_message');
		Route::get('/get-message/{id}', 'DashboardController@get_message_id');
	    Route::get('/my-profile', 'AdminController@my_profile');
		
		// For All Admins
		Route::resource('/admins', 'AdminController');
		Route::post('/admins/store', 'AdminController@store');
		Route::post('/admins/{id}/update', 'AdminController@update');
		Route::get('/admins/{id}/destroy', 'AdminController@destroy');
		Route::post('/admins/destroy/all', 'AdminController@delete_admin_all');

		Route::post('/admins/add-role', 'AdminController@add_role');



		// For All Teacher  
		Route::get('/teachers', 'UserController@show_all_teachers');
		Route::get('/teacher/create', 'UserController@create_teacher');
		Route::post('/teacher/store', 'UserController@store_teacher');
		Route::get('/teacher/{id}/edit', 'UserController@edit_teacher');
		Route::post('/teacher/{id}/update', 'UserController@update_teacher');
		Route::get('/teacher/{id}/destroy', 'UserController@destroy');
		// For All Teacher 
		Route::get('/students', 'UserController@show_all_students');
		Route::get('/student/{id}/destroy', 'UserController@destroy');

		// For All Users
		// Route::resource('/users', 'UserController');
		Route::post('/users/store', 'UserController@store');
		Route::post('/users/{id}/update', 'UserController@update');
		Route::get('/users/{id}/destroy', 'UserController@destroy');
		Route::post('/users/destroy/all', 'UserController@delete_user_all');

		// For Logout
		Route::any('logout', 'AdminAuth@logout');

		// For Settings
		Route::get('/settings', 'SettingsController@index');
		Route::post('/settings/update', 'SettingsController@update');

		// For Social Media
		Route::get('/settings/social-media', 'SettingsController@socialMedia');
		Route::post('/settings/social-media', 'SettingsController@socialMedia_store');
		Route::get('/settings/social-media/{id}/edit', 'SettingsController@socialMedia_edit');
		Route::post('/settings/social-media/update', 'SettingsController@socialMedia_update');
		Route::get('/settings/social-media/{id}/destroy', 'SettingsController@socialMedia_destroy');

		// For Why Choose
		Route::get('/settings/why-choose', 'SettingsController@why_choose');
		Route::get('/settings/why-choose/create', 'SettingsController@why_choose_create');
		Route::post('/settings/why-choose/store', 'SettingsController@why_choose_store');
		Route::get('/settings/why-choose/{id}/edit', 'SettingsController@why_choose_edit');
		Route::post('/settings/why-choose/update', 'SettingsController@why_choose_update');
		Route::get('/settings/why-choose/{id}/destroy', 'SettingsController@why_choose_destroy');

		// For Our Founders
		Route::get('/settings/our-founders', 'SettingsController@our_founders');
		Route::get('/settings/our-founders/create', 'SettingsController@our_founders_create');
		Route::post('/settings/our-founders/store', 'SettingsController@our_founders_store');
		Route::get('/settings/our-founders/{id}/edit', 'SettingsController@our_founders_edit');
		Route::post('/settings/our-founders/update', 'SettingsController@our_founders_update');
		Route::get('/settings/our-founders/{id}/destroy', 'SettingsController@our_founders_destroy');

		// For Contacts
		Route::get('/messages', 'ContactsController@index');
		Route::get('/messages/{id}/destroy', 'ContactsController@destroy');
		Route::get('/messages/{id}/done-read', 'ContactsController@done_read');

		
		// For Blog Website Categories
		Route::get('/blog/category', 'CategoryController@index');
		Route::get('/blog/category/{category}', 'CategoryController@show');
		Route::get('/blog/category/create','CategoryController@create');
		Route::post('/blog/category/store', 'CategoryController@store');
		Route::get('/blog/category/{id}/edit', 'CategoryController@edit');
		Route::post('/blog/category/update', 'CategoryController@update');
		Route::post('/blog/category/{id}/destroy', 'CategoryController@destroy');

		// For Blog Website Posts
		Route::get('/blog/posts', 'PostController@index');
		Route::get('/blog/post/{post}', 'PostController@show');
		Route::get('/blog/post/create', 'PostController@create');
		Route::post('/blog/post/store', 'PostController@store');
		Route::get('/blog/post/{id}/edit', 'PostController@edit');
		Route::post('/blog/post/update', 'PostController@update');
		Route::post('/blog/post/{id}/destroy', 'PostController@destroy');
		Route::post('/blog/comment/{id}/destroy', 'PostController@comment_destroy');

		// For Faqs
		Route::get('/faqs', 'FaqController@index');
		Route::get('/faq/{id}', 'FaqController@show');
		Route::get('/faq/create', 'FaqController@create');
		Route::post('/faq/store', 'FaqController@store');
		Route::get('/faq/{id}/edit', 'FaqController@edit');
		Route::post('/faq/update', 'FaqController@update');
		Route::get('/faq/{id}/destroy', 'FaqController@destroy');

		// Media Gallery
		Route::get('/media-gallery', 'MediaGalleryController@index');
		Route::get('/media-gallery/{id}', 'MediaGalleryController@show');
		// Route::get('/media-gallery/create', 'MediaGalleryController@create');
		Route::post('/media-gallery/store', 'MediaGalleryController@store');
		Route::get('/media-gallery/{id}/edit', 'MediaGalleryController@edit');
		Route::post('/media-gallery/update', 'MediaGalleryController@update');
		Route::get('/media-gallery/{id}/destroy', 'MediaGalleryController@destroy');

		// For Course Category
		Route::get('/courses-categories', 'CourseCategoryController@index');
		Route::get('/courses-categories/{id}', 'CourseCategoryController@show');
		Route::post('/courses-categories/store', 'CourseCategoryController@store');
		Route::get('/courses-categories/{id}/edit', 'CourseCategoryController@edit');
		Route::post('/courses-categories/update', 'CourseCategoryController@update');
		Route::get('/courses-categories/{id}/destroy', 'CourseCategoryController@destroy');

		// For Coupon Courses
		Route::any('/coupon', 'CouponController@index');
		Route::post('/add-coupon', 'CouponController@create');
		Route::get('/coupon/{id}/approve', 'CouponController@approve');
		Route::get('/coupon/{id}/delete', 'CouponController@delete');

		// For Course Files
		Route::get('/files', 'CourseFilesController@add_course_files');
		Route::post('/files', 'CourseFilesController@store_course_files');
		Route::get('/files/{id}/delete', 'CourseFilesController@file_delete');

		// For Newsletter
		Route::get('/newsletter', 'NewsletterController@index');
		Route::get('/newsletter/{id}/destroy', 'NewsletterController@destroy');

		// For Add Courses
		Route::get('courses', 'CoursesController@index');
		Route::get('add-courses', 'CoursesController@create');
		Route::post('courses/store', 'CoursesController@store');
		Route::get('course/{id}/edit', 'CoursesController@edit');
		Route::post('course/update', 'CoursesController@update');
		Route::get('course/{id}/delete', 'CoursesController@destroy');
		Route::get('course/{id}/approve', 'CoursesController@approve');
		Route::get('category/{courses_category}', 'CoursesController@searsh_category');

	});	
});
