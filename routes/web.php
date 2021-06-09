<?php

use Illuminate\Support\Facades\Route;

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

// Default Sample Route
//Route::get('/', function () {
//    return view('welcome');
//});


// APPLICATION ROUTE
//Route::group(['middleware'=>['web']], function(){
//
//});

// CHAPTER 4: ROUTE
Route::get('/', function(){
    return view('welcome');
});

Route::get('/admin', function(){
    return 'Admin Page';
});

Route::get('/about', function(){
    return 'About Page';
});

//Route::get('/contact', function(){
//    return 'Contact Page';
//});


Route::get('/admin/posts', function(){
    return 'Manage post is here';
});

Route::get('/hi/{name}', function($name){
    return "Hello " . $name . '. Welcome to Laravel';
});

//Route::get('/post/{id}',function($id){
//    return 'View post#' . $id;
//});

//Route::get('/post/{id}/{name}', function($id, $name){
//    return 'Requesting to see the post #' . $id . ' name ' . $name;
//});

// =================
// Naming Route

Route::get('/very/long/url', array('as'=>'veryLongURL', function(){
    $url = route('veryLongURL'); // the root/very/long/url was renamed as veryLongURL
    return $url;
}));

// CHAPTER 5: CONTROLLER
//Route::get('/post/{id}', 'App\Http\Controllers\PostController@index');
//Route::get('/post', [\App\Http\Controllers\PostController::class, 'index']);

Route::resource('posts', 'App\Http\Controllers\PostController');


// CHAPTER 6: VIEWS
// Tạo View và Custom Method
// -- Xem thêm "app/Http/Controllers/PostController.php" - phương thức contactPage()
// -- Tạo route để gọi đến PostController- phương thức contact
//    contact sẽ trả về view 'contact.blade.php'
Route::get('/contact', 'App\Http\Controllers\PostController@contact');

// Truyền dữ liệu cho View
Route::get('/viewpost/{id}/{name}', 'App\Http\Controllers\PostController@viewPost');


// CHAPTER 7: BLADE TEMPLATING ENGINE
// 7.1 Setup Master Blade Template
//   Xem thêm contact.blade.php
//   Tạo Master Blade Template ở resources/views/layouts/app.blade.php (thư mục layouts là thư mục tự tạo)
//   - template là file app.blade.php
//   - contact: truyền nội dung tương ứng vào template và nhận về file đã có các nội dung đó
//   - post: tương tự như contact

// 7.2 Truyền dữ liệu cho Blade Template
//   - Xem ở views/contact.blade.php




