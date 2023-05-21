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
            'name' => 'testing',
            'owner_user_id' => 1,
            'max_people' => 7,
            'min_people' => 6,
            'current_people' => 4,
            'deadline' => Carbon::now(),
        ]);
    }
}
