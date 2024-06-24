<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * 初始化应用程序数据库。
     * 
     * @return void 无返回值
     */
    public function run(): void
    {
        // 创建一个具有预设姓名、邮箱和密码的默认管理员用户。
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => static::$password ??= Hash::make('Admin@123'),
        ]);

        // 使用用户工厂创建四个随机用户。
        User::factory(4)->create();

        // 遍历所有已创建的用户，为每位用户生成十个关联笔记。
        User::all()->each(function (User $user) {
            Note::factory(10)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
