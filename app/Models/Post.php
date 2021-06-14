<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// 54. Soft Deleting
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    // 54. Soft Deleting
    use SoftDeletes;

    // Chỉ định rõ tên bảng mà Model này tham chiếu tới là bảng nào
    // Nếu không chỉ định rõ
    //   - Nếu tên lớp là Post -> tự hiểu bảng tham chiếu là 'posts'
    //   - Nếu tên lớp là Article -> tự hiểu bảng tham chiếu là 'articles'

    // Ở đây đang chỉ định rõ bảng tham chiếu là bảng 'posts'

    protected $table = 'posts';

    // Mặc định, Model tự hiểu trong bảng có cột tên là 'id'
    protected $primaryKey = 'id';
    // Nếu có cột id với tên khác thì cần chỉ định rõ tên cột primary đó
    //protected $primaryKey = 'post_id';

    protected $fillable = [
        // Cho phép thêm dữ liệu vào hai cột này cùng một lúc
        'title',
        'content'
    ];

    // 54. Soft Deleting
    protected $dates = ['deleted_at'];

    use HasFactory;
}
