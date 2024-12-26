<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserModel; // Import your UserModel
use Illuminate\Support\Facades\Hash; // For password hashing    

class UsersTableSeeder extends Seeder
{
    /** 
     * Run the database seeds.
     *    
     * @return void
     */
    public function run()
    {
         for ($i = 1; $i <= 20; $i++) {
			UserModel::create([
				'type' => 0, // Use integer value for 'user'
				'name' => "User $i",
				'email' => "user$i@example.com",
				'email_verified_at' => now(),
				'password' => Hash::make('password123'),
				'visible_password' => 'password123',
			]);
		}
    }
}
