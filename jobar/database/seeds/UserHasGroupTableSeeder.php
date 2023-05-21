<?php

use Illuminate\Database\Seeder;
use App\Models\UserHasGroup;

class UserHasGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserHasGroup::updateOrCreate(
            [
                'user_id' => 1,
                'group_id' => 1,
            ],
            [
                'user_id' => 1,
                'group_id' => 1,
            ]
        );
        UserHasGroup::updateOrCreate(
            [
                'user_id' => 1,
                'group_id' => 2,
            ],
            [
                'user_id' => 1,
                'group_id' => 2,
            ]
        );
    }
}
