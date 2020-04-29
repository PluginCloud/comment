<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("user_id")->comment("用户ID");
            $table->integer("collect_id")->nullable()->comment("文集ID");
            $table->integer("parent_id")->default(0)->comment("上级ID");
            $table->string("title")->comment("标题");
            $table->string("sub_title")->nullable()->comment("副标题");
            $table->string("keyword")->nullable()->comment("关键字");
            $table->string("description")->nullable()->comment("描述");
            $table->string("author")->nullable()->comment("作者");
            $table->string("from_name")->nullable()->comment("来源平台名称");
            $table->string("from_url")->nullable()->comment("来源链接");
            $table->text("content")->comment("内容");
            $table->integer("read_count")->default(0)->comment("阅读数");
            $table->integer("support_count")->default(0)->comment("支持数");
            $table->integer("not_support_count")->default(0)->comment("不支持数");
            $table->integer("collect_count")->default(0)->comment("收藏数");
            $table->integer("comment_count")->default(0)->comment("评论数");
            $table->tinyInteger("is_online")->default(0)->comment("上线：1是0否");
            $table->tinyInteger("is_position")->default(0)->comment("推荐：1是0否");
            $table->tinyInteger("status")->default(1)->comment("状态：1正常0禁止");
            $table->integer("order")->default(0)->comment("排序");
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('comment_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger("type")->default(0)
                ->comment("用户类型：0.普通用户，1.会员，2.管理员，3.超级管理员");
            $table->string("username")->comment("用户名");
            $table->string("nickname")->comment("昵称");
            $table->string("picture_url")->comment("头像URL");
            $table->string("email")->nullable()->comment("邮箱");
            $table->string("mobile")->nullable()->comment("手机号码");
            $table->string("password")->comment("密码");
            $table->tinyInteger("sex")->default(1)->comment("性别：1.男，2.女");
            $table->dateTime("birthday")->nullable()->comment("生日");
            $table->integer("follow_count")->default(0)->comment("关注数");
            $table->integer("fans_count")->default(0)->comment("粉丝数");
            $table->tinyInteger("is_position")->default(0)->comment("推荐：1是0否");
            $table->tinyInteger("status")->default(1)->comment("状态：1正常0禁止");
            $table->integer("order")->default(0)->comment("排序");
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('comment_user_collects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("user_id")->comment("用户ID");
            $table->string("name")->comment("文集名称");
            $table->string("thumb_url")->nullable()->comment("封面URL");
            $table->integer("read_count")->default(0)->comment("浏览数");
            $table->integer("support_count")->default(0)->comment("支持数");
            $table->integer("not_support_count")->default(0)->comment("不支持数");
            $table->integer("collect_count")->default(0)->comment("收藏数");
            $table->tinyInteger("is_online")->default(0)->comment("上线：1是0否");
            $table->tinyInteger("is_position")->default(0)->comment("推荐：1是0否");
            $table->tinyInteger("status")->default(1)->comment("状态：1正常0禁止");
            $table->integer("order")->default(0)->comment("排序");
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('comment_user_follows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("user_id")->comment("用户ID");
            $table->tinyInteger("type")->comment("类型：1.用户，2.文章，3.文集");
            $table->tinyInteger("action_type")->comment("行为类型：1.关注，2.阅读，3.点赞，4.反对");
            $table->integer("data_id")->comment("数据ID");
            $table->tinyInteger("is_online")->default(1)->comment("上线：1是0否");
            $table->tinyInteger("is_position")->default(0)->comment("推荐：1是0否");
            $table->tinyInteger("status")->default(1)->comment("状态：1正常0禁止");
            $table->integer("order")->default(0)->comment("排序");
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('comment_user_ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("user_id")->comment("用户ID");
            $table->tinyInteger("type")->default(0)
                ->comment("类型：0.广告连接");
            $table->string("place_code")->comment("位置代码");
            $table->text("content")->comment("内容");
            $table->timestamp("expire_at")->nullable()->comment("到期时间");
            $table->string("remark")->nullable()->comment("备注");
            $table->tinyInteger("is_online")->default(0)->comment("上线：1是0否");
            $table->tinyInteger("is_position")->default(0)->comment("推荐：1是0否");
            $table->tinyInteger("status")->default(1)->comment("状态：1正常0禁止");
            $table->integer("order")->default(0)->comment("排序");
            $table->softDeletes();
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
        Schema::dropIfExists('comment_contents');
        Schema::dropIfExists('comment_users');
        Schema::dropIfExists('comment_user_collects');
        Schema::dropIfExists('comment_user_follows');
        Schema::dropIfExists('comment_user_ads');
    }
}
