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

Route::pattern('id', '[0-9]+');
// Route::pattern('courses_category', '[a-z]+, [A-Z]+');

/*Route::get('/', function () {
    return view('welcome');
});*/

// Route::get('/get-message', 'DashboardController@get_message');
// Route::get('/get-message/{id}', 'DashboardController@get_message_id');

Route::get('/', 'IndexController@index');

// Route::get('admission', 'AdmissionController@admission');
// Route::post('admission', 'AdmissionController@admission_post');

// contacts
Route::get('contacts', 'IndexController@contacts');
Route::post('contacts', 'IndexController@contacts_store');

// About
Route::get('about', 'IndexController@about');

// Help
Route::get('help', 'IndexController@help');

// Faq
Route::get('faqs', 'IndexController@faqs');

// media-gallery
Route::get('media-gallery', 'IndexController@media_gallery');

// Blog
Route::get('blog', 'IndexController@blog');
Route::get('blog/blog-post/{id}', 'IndexController@blog_post');
Route::get('blog/category/{id}', 'IndexController@filter_catecory');
Route::post('blog/comment-store', 'IndexController@blog_comments_store');
Route::post('blog/search', 'IndexController@search');

// View All Courses // Filtter Categories Courses
Route::get('courses-grid', 'IndexController@all_courses');
Route::get('courses-list', 'IndexController@all_courses_list');
Route::get('category/{courses_category}', 'IndexController@searsh_category');
Route::get('course-details/{course_title}', 'IndexController@course_details');
Route::post('/teacher-detail/{name}', 'IndexController@teacher_detail');

// For Shopping Cart Courses
Route::get('shopping-cart', 'CartController@getCart');
Route::get('add-to-cart/{id}', 'CartController@getAddToCart');
Route::get('checkout', 'CartController@getCheckout');
Route::post('checkout', 'CartController@postCheckout');
Route::any('reduce/{id}', 'CartController@getReduceByOne');
Route::any('remove/{id}', 'CartController@getRemoveItem');
Route::post('/getAddToCoupon', 'CartController@getAddToCoupon');

// Newsletter Form
Route::post('/newsletter_form', 'IndexController@newsletter_form');

Route::post('/searsh', 'IndexController@searsh');


// For Login student
Route::group(['middleware' => ['roles'], 'roles' => ['Student', 'student']], function () {

	Route::get('/profile/{name?}', 'ProfileStudentController@profile');
	Route::post('/profile/{id}/update', 'ProfileStudentController@update_profile');
	Route::group(['prefix' => 'dashboard'], function () {
		Route::get('/my-course', 'ProfileStudentController@my_courses');
	});
	Route::get('/logout', 'ProfileStudentController@logout');
});

// For Login student
Route::group(['middleware' => ['roles'], 'roles' => ['teacher', 'Teacher']], function () {

	Route::get('/my-profile/{name}', 'ProfileTeacherController@profile');
	Route::post('/profile/update', 'ProfileTeacherController@update_profile');
	Route::get('/logout', 'ProfileTeacherController@logout');

	Route::group(['prefix' => 'dashboard'], function () {

		Route::get('/', 'CoursesTeacherController@dashboard');
		// For Add Courses
		Route::get('courses', 'CoursesTeacherController@index');
		Route::get('add-courses', 'CoursesTeacherController@create');
		Route::post('courses/store', 'CoursesTeacherController@store');
		Route::get('course/{id}/edit', 'CoursesTeacherController@edit');
		Route::post('course/update', 'CoursesTeacherController@update');
		Route::get('course/{id}/delete', 'CoursesTeacherController@destroy');
		Route::get('category/{courses_category}', 'CoursesTeacherController@searsh_category');

		Route::get('all-comments', 'CoursesTeacherController@all_comments');
		Route::get('comment/{id}/dane-read', 'CoursesTeacherController@dane_read_comment');

		Route::any('/coupon', 'CouponController@index');
		Route::post('/add-coupon', 'CouponController@create');
		Route::get('/{coupon_code}/delete', 'CouponController@delete');

		Route::get('/my-courses', 'ProfileTeacherController@my_courses');

		Route::get('/files', 'CoursesTeacherController@add_course_files');
		Route::post('/files', 'CoursesTeacherController@store_course_files');
		Route::get('/files/{id}/delete', 'CoursesTeacherController@file_delete');

	});

});

Route::group(['middleware' => ['roles'], 'roles' => ['Admin', 'Editor', 'Teacher', 'Student']], function () {

	// For Comment Course
	Route::post('/course/comment-store', 'IndexController@course_comments_store');
});

Route::any('/logout', function(){

	\Auth::logout();
    return redirect('/login');
});