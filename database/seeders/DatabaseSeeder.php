<?php


namespace Database\Seeders;
use Illuminate\Support\Facades\DB;


use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder




{
    public function run(): void
    {
        // Clear existing data
        DB::table('users_api_db')->truncate();
        
        $users = [
            ['id' => 43, 'name' => 'Deepak', 'email' => 'deepak@example.com', 'mobileno' => '7890123412'],
            ['id' => 44, 'name' => 'Deepak', 'email' => 'k@example.com', 'mobileno' => '0000000000'],
            ['id' => 45, 'name' => 'mahendra', 'email' => 'abcd@gmail.com', 'mobileno' => '9074212595'],
            ['id' => 46, 'name' => 'Jeetendra', 'email' => 'jeetu@gmail.com', 'mobileno' => '9087654321'],
            ['id' => 47, 'name' => 'satish', 'email' => 'satuu@gmail.com', 'mobileno' => '9543216789'],
            ['id' => 48, 'name' => 'prateek', 'email' => 'prateek@gmail.com', 'mobileno' => '9522960057'],
            ['id' => 49, 'name' => 'mohit', 'email' => 'mohit@gmail.cpm', 'mobileno' => '9999999999'],
            ['id' => 50, 'name' => 'mohit', 'email' => 'moihit@gmail.com', 'mobileno' => '9999999998'],
            ['id' => 51, 'name' => 'mohit', 'email' => 'mkoihit@gmail.com', 'mobileno' => '9999999598'],
            ['id' => 52, 'name' => 'Alex', 'email' => 'alex@gmail.com', 'mobileno' => '7470353196'],
            ['id' => 53, 'name' => null, 'email' => null, 'mobileno' => null],
            ['id' => 54, 'name' => 'Rahul Yadav', 'email' => 'ry674661@gmail.com', 'mobileno' => '1234567890'],
            ['id' => 55, 'name' => 'Job', 'email' => 'Job@gmail.com', 'mobileno' => '1234567899'],
            ['id' => 56, 'name' => 'indore', 'email' => 'indore@gmail.com', 'mobileno' => '858523'],
            ['id' => 57, 'name' => 'Harshal', 'email' => 'harshal@gmail.com', 'mobileno' => '9876543210'],
        ];

        foreach ($users as $user) {
            DB::table('users_api_db')->insert(array_merge($user, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        DB::statement('ALTER TABLE users_api_db AUTO_INCREMENT = 58;');
    }
}