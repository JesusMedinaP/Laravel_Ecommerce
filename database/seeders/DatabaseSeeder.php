<?php


use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Storage;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('categories');
        Storage::disk('public')->makeDirectory('categories');

        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
