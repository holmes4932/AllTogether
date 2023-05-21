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
            ['name' => 'admin'],
            [
                'name' => 'admin',
                'email'    => 'holmes4932@gmail.com',
                'password' => 'admin123',
            ]
        );
    }
}
