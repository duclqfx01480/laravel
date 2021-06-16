<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('path'); // đường dẫn đến hình ảnh
            $table->integer('imageable_id'); // associated tới user_id hoặc post_id, tùy thuộc field bên dưới là gì
            $table->string('imageable_type'); // namespace của Model, ví dụ: App\Models\User
            // ví dụ:
            // nếu imageable_type là App\Models\User thì imageable_id refer đến user_id
            // nếu imageable_type là App\Models\Post thì imageable_id refer đến post_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
