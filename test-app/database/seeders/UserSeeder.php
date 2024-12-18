<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'title' => 'テスト',
            'body' => 'シーダーのテストを実施します',
            'user_id' => 1,
        ]);
        //
    }
}
