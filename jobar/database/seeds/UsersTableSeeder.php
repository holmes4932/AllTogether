<?php

use Illuminate\Database\Seeder;
use App\Models\Users;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::updateOrCreate(
            ['id' => 1],
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'holmes4932@gmail.com',
                'password' => 'admin123',
            ]
        );
        Users::updateOrCreate(
            ['id' => 2],
            [
                'id' => 2,
                'name' => 'test',
                'email' => 'test@gmail.com',
                'password' => 'test1234',
            ]
        );
    }
}
