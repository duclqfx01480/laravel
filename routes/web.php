<?php



use Illuminate\Support\Facades\Route;

// CHAPTER 10: ELOQUENT / ORM (OBJECT RELATIONAL MODEL)
// Dòng bên dưới là của Chapter 10
use App\Models\Post;

use App\Models\User;

// 67. HasManyThrough
use App\Models\Country;

// 70.Polymorphic Relation
use App\Models\Photo;
use App\Models\Video;

// 74.
use App\Models\Tag;

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


/*
|--------------------------------------------------------------------------
| CHAPTER 11: ELOQUENT RELATIONSHIPS
|--------------------------------------------------------------------------
*/

// 59. Quan hệ Một-Một (One-to-One Relationship)
// 1. Tạo thêm cột 'user_id' trong bảng posts
//   - Bằng cách thêm một cột trong migration create_posts_table
//   - $table->integer('user_id')->unsigned();
//   - php artisan migrate:refresh để chạy lại migrate
// 2. Thêm user vào bảng user
// 3. Thêm một post vào bảng posts, có user_id
// 4. Viết hàm post trong app/Models/User.php
// 5. Viết Route để truy cập & lấy ra post của một user nào đó
// note: Thêm 'use App\Models\User;'
// dùng hasOne
Route::get('/user/{id}/post', function($id){
    // Trả về các post của id có mã là $id
    return User::find($id)->post; // truy cập thuộc tính ->title
});

// 60. Inverse Relation (Đảo ngược quan hệ)
// Trả về user của một post có id nào đó
// 1. Viết Route
Route::get('post/{id}/user', function($id){
    return Post::find($id)->user; // truy cập thuộc tính ->name
});
// 2. Viết hàm user trong app/Models/Post
// note: dùng belongsTo


// 61. Quan hệ Một-Nhiều (One-to-Many Relationship)
// 1. Viết hàm posts trong app\Models\User
// 2. Tạo Route
Route::get('/posts', function(){
    $user = User::find(1); // Lấy ra user có id là 1
    foreach($user->posts as $post){
        echo $post->title . "<br>";
    }
});

// 63-64. Quan hệ Nhiều-Nhiều (Many-To-Many Relationship)
// Mục tiêu: Tạo bảng role
// 1. Tạo Model Role, -m để tạo migration
//  Lệnh này vừa tạo ra Model Role, vừa tạo ra một Migration (create_roles_table)
// php artisan make:model Role -m
// Trong migration create_roles_table, bổ sung cột name (kiểu string) để lưu tên của role

// 2. Tạo Migration để tạo bảng users_roles (bảng mapping cho quan hệ nhiều-nhiều)
// php artisan make:migration create_users_roles_table --create=role_user
// (Tạo ra Migration create_users_roles_table)
// Trong migration create_users_roles_table thêm hai cột:
//  - user_id
//  - role_id

// 3. Chạy Migrate
// php artisan migrate

// 4. Viết quan hệ trong app\Models\User (public function roles)
// 5. Viết Route
Route::get('/user/{id}/role', function($id){
    $user = User::find($id);//->roles;
    foreach($user->roles as $role){
        return $role->name . "<br>";
    }

//    $user = User::find($id)->roles()->orderBy('id', 'desc')->get();
//    return $user;
});


// 65. Querying Intermediate Table
// Invert
// 1. Viết trong app/Models/Role, hàm users
// 2. Viết Route
Route::get('/user/pivot', function(){
    $user = User::find(1);

    foreach($user->roles as $role){
        return $role->pivot; //->created_at;
    }
});

// 66, 67. Has Many through Relation
// 1. Tạo Model Country và Migration
// php artisan make:model Country -m
// Migration create_countries_table, thêm cột name (tham khảo thêm file)
// 2. Tạo thêm cột country_id cho bảng user
// php artisan make:migration add_country_id_column_to_users_table --table=users
// Viết hàm up và down cho add_country_id_column_to_users_table (tham khảo thêm file)
// 3. Chạy Migrate
// php artisan migrate
// 4. Viết hàm posts trong app/Models/Country
// 5. Viết Route
Route::get('/user/country', function(){
    $country = Country::find(3);
    foreach($country->posts as $post){
        echo $post->title . "<br>";
    }
});

// 68, 69. Polymorphic Relation
/* Description (Mục tiêu)
- Photo: Ảnh ID 1 thuộc về Post này, ảnh ID 2 thuộc về User
- Tức là photo có thể thuộc về Post, hoặc thuộc về User
*/
// 1. Tạo Model - tạo thêm cả migration
// php artisan make:model Photo -m
// -> Tạo Migration 2021_06_16_110501_create_photos_table
// 2. Viết code trong migration create_photos_table
// Thêm các cột - dòng lệnh từ 18-20
// 3. Chạy migration
// php artisan migrate
// 3.1 Chú ý -> Xem migration create_posts_table (dòng 18 - 20)
//           -> Triển khai quan hệ đa hình nên tạm comment dòng $table->integer('user_id')->unsigned();
// 4. Refresh (roll back và chạy lại) Migration do có thay đổi trong Model Post
// php artisan migrate:refresh
// 5. Thêm dữ liệu vào DB mySQL vì khi refresh xong sẽ mất hết dữ liệu
// 6. Trong model Photo : Tạo Quan hệ cho bảng chính (bảng Photo) ở Photo (app\Models\Photo)
// 7.Trong model Post : viết hàm trả về photos
// 8. Trong model User : tương tự
// 9. Viết Route
Route::get('/user/photos', function(){
    $user = User::find(1);
    //$user = User::all();
    foreach($user->photos as $photo){
        return $photo; //->path
    }
});

Route::get('/post/{id}/photos', function($id){
    $post = Post::find($id);
    foreach($post->photos as $photo){
        echo $photo->path . "<br>";
    }
});

// 70. Polymorphic Relation
// Lấy owner của photo
Route::get('/photo/{id}/post', function($id){
    // Lấy ra photo
    $photo = Photo::findOrFail($id);
    // Lấy ra owner
    return $photo->imageable;
});

// 71, 72. Polymorphic Relation - Many to Many
// 1. Tạo Model Video
// php artisan make:model Video -m
// Tạo ra Migration create_videos_table và Model Video
// 2. Tạo Model Tag
// php artisan make:model Tag -m
// Tạo ra Migration create_tags_table và Model Tag
// 3. Tạo Model Taggable
// php artisan make:model Taggable -m
// Tạo ra Migration create_taggables_table và Model Taggable
// 4. Định nghĩa Migration
//   4.1 Video Migration (create_videos_table)
//      Thêm $table->string('name')
//   4.2 Tag Migration (create_tags_table)
//      Thêm $table->string('name');
//   4.3 Taggable Migration (create_taggables_table)
//      - Comment out id - không cần increment id
//      - Comment out timestamps - không cần timestamps
//      - Thêm:
//         $table->integer('tag_id');
//         $table->integer('taggable_id');
//         $table->integer('taggable_type');
// 72.
// 5. Trong Post Model - Viết quan hệ
// 6. Trong Tag Model - Viết quan hệ
// 73.
// 7. Chạy Migration để tạo các bảng, trước khi thêm mới dữ liệu
//  php artisan migrate
// 8. Thêm dữ liệu
// 9. Viết Route
// Lấy ra các tag thuộc về một post có id truyền vào
Route::get('/post/{id}/tag', function($id){
    $post = Post::find($id);
    foreach($post->tags as $tag){
        echo $tag->name;
    }
});
// *S - Lấy ra các tag thuộc về một post có id truyền vào
Route::get('/video/{id}/tag', function($id){
    $video = Video::find($id);
    foreach($video->tags as $tag){
        echo $tag->name;
    }
});

// 74.
Route::get('/tag/post', function(){
    $tag = Tag::find(2);
    foreach($tag->posts as $post){
        echo $post->title;
    }
});


/*
|--------------------------------------------------------------------------
| CHAPTER 12: TINKER
|--------------------------------------------------------------------------
*/
// 76. Tạo dữ liệu với Tinker
// php artisan tinker -> để bắt đầu làm việc với Tinker
// Thêm một post mới vào bảng posts: Cách 1
// $post = App\Models\Post::create(['title'=>'PHP Post from Tinker','content'=>'PHP Content from Tinker'])

// Cách thêm một dòng (Cách 2)
// Tạo một instance của App\Models\Post
// $post = new App\Models\Post
// Sau đó có thể gán thuộc tính
// $post->title = 'Davinci Code'
// $post->content = 'by Dan Brown'
// Lưu vào DB
// $post->save()
// Xem lại $post đã lưu vào bảng posts, có cả các cột updated_at, created_at,...

// 77. Tìm kiếm một dòng dữ liệu và sử dụng constraints trong Tinker
// $post = App\Models\Post::find(1)
// $post = App\Models\Post::where('id',2)->first()
// $post = App\Models\Post::whereId(3)->first()

// 78. Cập nhật và xóa dữ liệu trong Tinker
// 1. Cập nhật dữ liệu
// Chọn ra dòng cần cập nhật
// $post = App\Models\Post::find(3)
// Tiến hành cập nhật
// $post->title = 'Updated title'
// $post->content = 'Update content'
// Lưu cập nhật
// $post->save()

// 2. Xóa dữ liệu
// Xóa dữ liệu (soft delete)
// $post->delete()
// Lấy những post đã soft delete (đưa vào trash)
// $post = App\Models\Post::onlyTrashed()
// Xóa hoàn toàn (permanently)
// $post->forceDelete()

// 79. Relation trong Tinker
// $user = App\Models\User::find(1)
// $user->posts
// => không có kết quả, vì trong bảng posts không có user_id (Migration create_posts_table không có cột user_id)

// $user->roles
