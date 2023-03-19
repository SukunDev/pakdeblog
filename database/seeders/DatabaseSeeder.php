<?php

namespace Database\Seeders;

use App\Models\Tags;
use App\Models\User;
use App\Models\Posts;
use App\Models\Categories;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(OptionsSeeder::class);
        User::create([
            'email' => 'xxxxxxxxx@gmail.com',
            'name' => 'PakdeKun',
            'username' => 'PakdeKun',
            'password' => bcrypt('xxxxxxxx'),
        ]);
        Categories::create([
            'name' => 'Programing',
            'slug' => 'programing',
        ]);
        Categories::create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);
        Categories::create([
            'name' => 'Web Design',
            'slug' => 'web-design',
        ]);
        Tags::create([
            'name' => 'Python',
            'slug' => 'python',
        ]);
        Tags::create([
            'name' => 'PHP',
            'slug' => 'php',
        ]);
        Tags::create([
            'name' => 'Traveling',
            'slug' => 'traveling',
        ]);
        Posts::factory(50)->create();
    }
}
