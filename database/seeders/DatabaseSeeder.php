<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
//        User::factory()->create([
//            'user_name' => 'admin',
//            'password' => Hash::make('admin'),
//            'user_role_id' => 1,
//            'user_status_id' => 1,
//            'date' => Carbon::now()->timestamp
//        ]);
        DB::table('users')->insert([
            'user_name' => 'admin',
            'password' => Hash::make('admin'),
            'user_role_id' => 1,
            'user_status_id' => 1,
            'date' => Carbon::now()->timestamp
        ]);
        $statuses = [[
            'english_title' => 'active' ,
            'persian_title' => 'فعال',
            'date' => Carbon::now()->timestamp
        ],[
            'english_title' => 'not active',
            'persian_title' => 'غیرفعال',
            'date' => Carbon::now()->timestamp
        ]];
        DB::table('product_statuses')->insert($statuses);

    }
}
