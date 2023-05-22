<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Groups;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Groups::create([
            'name' => '50 嵐外送',
            'owner_user_id' => 1,
            'max_people' => 1000,
            'min_people' => 500,
            'current_people' => 60,
            'deadline' => Carbon::now(),
        ]);
        Groups::create([
            'name' => '明年住宿室友',
            'owner_user_id' => 1,
            'max_people' => 4,
            'min_people' => 4,
            'current_people' => 2,
            'deadline' => Carbon::now(),
        ]);
        Groups::create([
            'name' => '台東回新竹共乘',
            'owner_user_id' => 2,
            'max_people' => 5,
            'min_people' => 4,
            'current_people' => 2,
            'deadline' => Carbon::now(),
        ]);
    }
}
