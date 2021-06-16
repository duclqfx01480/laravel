<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Trả về các bài post của một user nào đó
    public function post(){
        // có tham số thứ 2 nhưng do mặc định là 'user_id' nên không truyền vào
        // tự hàm hasOne sẽ hiểu có tham số thứ 2 ('user_id')
        return $this->hasOne('App\Models\Post');

        // nếu cột user_id được đặt tên khác (ví dụ the_user_id) thì truyền vào ở tham số thứ 2
        //return $this->hasOne('App\Models\Post', 'the_user_id');
    }

    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

    public function roles(){
        // Bảng được đặt tên là role_user
        return $this->belongsToMany('App\Models\Role'); //->withPivot('created_at');

        // Nếu đặt tên khác thì dùng
        // uncomment để xem gợi ý cú pháp & biết thêm về ý nghĩa các tham số
        // role_users là tên bảng tự viết (không theo quy tắc role_user không có 's')
        // user_id và role_id là khóa ngoại
        //return $this->belongsToMany('App\Models\Role', 'role_users', 'user_id', 'role_id');
    }

    public function photos(){
        return $this->morphMany('App\Models\Photo', 'imageable');
    }

}
