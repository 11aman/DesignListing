<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = \App\Models\User::create([
            'name' => 'Admin Name',
            'email' => 'admin@yopmail.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'admin',  // assign the admin role
        ]);
        
        $this->call([
            ProductCategorySeeder::class,
            FinishSeeder::class,
            SizeSeeder::class,
            DesignSeeder::class,
            DesignFinishSizeSeeder::class,
            LookupTablesSeeder::class,
            ProductSeeder::class,
            FinishProductSeeder::class,
            SizeStructureSeeder::class
        ]);
    }
}
