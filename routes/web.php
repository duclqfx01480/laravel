<?php

use Illuminate\Support\Facades\Route;

// CHAPTER 10: ELOQUENT / ORM (OBJECT RELATIONAL MODEL)
// Dòng bên dưới là của Chapter 10
use App\Models\Post;

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

/*
|--------------------------------------------------------------------------
| CHAPTER 4: ROUTE
|--------------------------------------------------------------------------
*/

// Comment để chỉ tạo các Route liên quan trong CHAPTER 9 - RAW SQL QUERIES
//Route::get('/', function(){
//    return view('welcome');
//});
//
//Route::get('/admin', function(){
//    return 'Admin Page';
//});
//
//Route::get('/about', function(){
//    return 'About Page';
//});

//Route::get('/contact', function(){
//    return 'Contact Page';
//});

//Route::get('/admin/posts', function(){
//    return 'Manage post is here';
//});
//
//Route::get('/hi/{name}', function($name){
//    return "Hello " . $name . '. Welcome to Laravel';
//});

//Route::get('/post/{id}',function($id){
//    return 'View post#' . $id;
//});

//Route::get('/post/{id}/{name}', function($id, $name){
//    return 'Requesting to see the post #' . $id . ' name ' . $name;
//});

// =================
// Naming Route

//Route::get('/very/long/url', array('as'=>'veryLongURL', function(){
//    $url = route('veryLongURL'); // the root/very/long/url was renamed as veryLongURL
//    return $url;
//}));


/*
|--------------------------------------------------------------------------
| CHAPTER 5: CONTROLLER
|--------------------------------------------------------------------------
*/

//Route::get('/post/{id}', 'App\Http\Controllers\PostController@index');
//Route::get('/post', [\App\Http\Controllers\PostController::class, 'index']);

//Route::resource('posts', 'App\Http\Controllers\PostController');


/*
|--------------------------------------------------------------------------
| CHAPTER 6: VIEWS
|--------------------------------------------------------------------------
*/
// Tạo View và Custom Method
// -- Xem thêm "app/Http/Controllers/PostController.php" - phương thức contactPage()
// -- Tạo route để gọi đến PostController- phương thức contact
//    contact sẽ trả về view 'contact.blade.php'
//Route::get('/contact', 'App\Http\Controllers\PostController@contact');

// Truyền dữ liệu cho View
//Route::get('/viewpost/{id}/{name}', 'App\Http\Controllers\PostController@viewPost');


/*
|--------------------------------------------------------------------------
| CHAPTER 7: BLADE TEMPLATING ENGINE
|--------------------------------------------------------------------------
*/
// 7.1 Setup Master Blade Template
//   Xem thêm contact.blade.php
//   Tạo Master Blade Template ở resources/views/layouts/app.blade.php (thư mục layouts là thư mục tự tạo)
//   - template là file app.blade.php
//   - contact: truyền nội dung tương ứng vào template và nhận về file đã có các nội dung đó
//   - post: tương tự như contact

// 7.2 Truyền dữ liệu cho Blade Template
//   - Xem ở views/contact.blade.php


/*
|--------------------------------------------------------------------------
| CHAPTER 8: MIGRATIONS
|--------------------------------------------------------------------------
*/
// Xem database/migrations/2021_06_10_135357_create_posts_table - phần create
// php artisan make:migration create_posts_table --create="posts"
// php artisan migrate
// php artisan migrate:rollback

// Xem database/migrations/2021_06_10_143835_add_is_admin_column_to_posts_table
// php artisan make:migration create_is_admin_column_to_posts_table --table="posts"

// reset -> rollback tất cả các migration đã thực hiện
// php artisan migrate:reset

// refresh -> rollback và migrate lại từng migration
// php artisan migrate:refresh


/*
|--------------------------------------------------------------------------
| CHAPTER 9: RAW SQL QUERIES
|--------------------------------------------------------------------------
*/
// Insert data into database
//Route::get('/insert', function(){
//    DB::insert('INSERT INTO posts(title, content) VALUES(?,?)',['PHP with Laravel', 'Laravel is awesome!']);
//});

// Read data from database
//Route::get('/read', function(){
//    $result = DB::select('SELECT * FROM posts WHERE id=?', [2]);
    //return var_dump($result);
    // return ở đây, hoặc dùng vòng lặp để lấy ra các field
//    return $result;
//    foreach($result as $post){
//        return $post->title;
//    }
//});

// Update data in the database
//Route::get('/update', function(){
//    $updatedRow = DB::update('UPDATE posts SET title=? WHERE id=?', ['Updated title', 2]);
//    return $updatedRow;
//});

// Delete data from the database
//Route::get('/delete', function(){
//    $deletedRow = DB::delete('DELETE FROM posts WHERE id = ?',[2]);
//    return $deletedRow;
//});



/*
|--------------------------------------------------------------------------
| CHAPTER 10: ELOQUENT / ORM (OBJECT RELATIONAL MODEL)
|--------------------------------------------------------------------------
*/
// 1. Tạo Model
// php artisan make:model Post => Tạo ra Model tên là Post ở "app/Models/Post.php"
// xem file "app/Models/Post.php" để biết thêm chi tiết
// Sau khi tạo model, thiết lập xong một số thứ (tên bảng, tên cột primaryKey,...), tạo Route như sau

// Sử dụng Eloquent để đọc dữ liệu
Route::get('/read', function(){
    // Lấy ra tất cả records và gán cho biến $posts
    // Post đã khai báo ở phần use -> tham chiếu đến Model Post đã tạo ở "app/Models/Post.php"
    $posts = Post::all();
    foreach($posts as $post){
        return $post->title;
    }
});

Route::get('/find', function(){
    // Tìm post có id là 2 - chú ý nếu id không tồn tại thì không tìm ra -> exception
    $post = Post::find(2);
    return $post->title;
});

// Đọc / lọc (tìm) dữ liệu có điều kiện
Route::get('/findwhere', function(){
    $posts = Post::where('id', 3)->orderBy('id', 'desc')->take(1)->get();
//    foreach($posts as $post){
//        return $post->content;
//    }
    return $posts;
});

// ----- Insert data (support Route trên để thêm dữ liệu -> test)
Route::get('/insertnewrow/{title}/{content}', function($title, $content){
    DB::insert('INSERT INTO posts(title, content) VALUES(?,?)', [$title, $content]);
});
// ----- end

Route::get('/findmore', function(){
    // Trả về một record, nếu không tìm ra thì trả về một Exception
    //$posts = Post::findOrFail(3);
    //return $posts;

    $posts = Post::where('id', '<', 5)->firstOrFail();
    return $posts;
});


// 50. Dùng Eloquent để insert dữ liệu
Route::get('/basicinsert', function(){
    // Tạo một instance của Post Model
    $post = new Post;

    // Gọi các thuộc tính (cột) và gán giá trị
    $post->title = 'Marketing';
    $post->content = 'Principles of Marketing by Philip Kotler';

    // Lưu dữ liệu vào Eloquent
    $post->save();
});

// 50. Dùng Eloquent để update dữ liệu
// - Giống Route trên, chỉ thay lệnh lấy ra một record để update
Route::get('/basicupdate', function(){

    // Nếu muốn cập nhật một record có sẵn thì trước tiên tìm record đó đã
    $post = Post::find(4);

    // Gọi các thuộc tính (cột) và gán giá trị
    $post->title = 'Marketing';
    $post->content = 'Principles of Marketing by Philip Kotler';

    // Lưu dữ liệu vào Eloquent
    $post->save();
});

// 51. Thêm dữ liệu / cấu hình mass assignment

Route::get('/create', function(){
    Post::create(['title'=>'Create with Eloquent', 'content'=>'Wow, I \'m learning PHP Laravel']);
    // Laravel không cho phép mass insertion (thêm dữ liệu vào tất cả các cột [của một record] một lúc)
    // Để bật cho phép -> xem Post.php, phần fillable
});

// 52. Cập nhật với Eloquent
Route::get('/update', function(){
    Post::where('id', 2)->where('is_admin', 0)->update(['title'=>'Clean Code', 'content'=>'Must read book']);
});

// 53. Delete
Route::get('/delete/{id}', function($id){
    $post = Post::find($id);
    $post->delete();
});

Route::get('/delete2', function(){
    // Xóa multiple records (xóa các record có id bằng 4,5)
    Post::destroy([4,5]);
    Post::where('is_admin', 0)->delete();
});

// 54. Soft Deleting
// 1. Thêm SoftDeletes vào 'Post.php'
// 2. Tạo một migration mới để thêm cột 'deleted_at' vào bảng posts
// php artisan make:migration add_deleted_at_column_to_posts_table --table=posts
// -> migration ở '2021_06_14_055447_add_deleted_at_column_to_posts_table'
// Viết code cho migration -> xem thêm ở migrartion vừa tạo
// 3. Tạo Route
Route::get('/softdelete', function(){
    Post::find(3)->delete();
});

// 55. Lấy các dữ liệu đã bị xóa (Retrieving Deleted/ Trashed Record)
Route::get('/readsoftdelete', function(){
    // $post sau là null do không lấy ra được record đã bị softDelete
    //$post = Post::find(3);
    //return $post;

    // Lấy ra record đã bị xóa bằng withTrashed
    //$post = Post::withTrashed()->where('id', 3)->get();
    //return $post;

    // Lấy ra tất cả record bị xóa bằng onlyTrashed
    $post = Post::onlyTrashed()->where('is_admin', 0)->get();
    return $post;
});

// 56. Phục hồi record đã xóa
Route::get('/restore', function(){
    Post::withTrashed()->where('is_admin', 0)->restore();
});

// 57. Xóa một record vĩnh viễn
Route::get('/forcedelete', function(){
    Post::onlyTrashed()->where('is_admin', 0)->forceDelete();
});




