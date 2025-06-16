<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //登録する値として「ユーザー名」「メールアドレス」「パスワード」は必須で登録する。
        DB::table('users')->insert([
            [
                'username' => 'Atlas一郎',
                'email' => 'test@example.com',
                'password' => bcrypt('password')
            ]
        ]);
    }
}
