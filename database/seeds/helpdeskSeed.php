<?php

use App\User;
use Illuminate\Database\Seeder;

class helpdeskSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'm.nabih@vitalcareprod.com',
            'password' => bcrypt('password'),
            'phone_number' => "0770169703",
            'role' => 'help desk',
            'name' => 'Mehdi Nabih',
        ]);

        $user->helpDesk()->create([

        ]);

        $user = User::create([
            'email' => 'y.boughrara@vitalcareprod.com',
            'password' => bcrypt('password'),
            'phone_number' => "0770249933",
            'role' => 'help desk',
            'name' => 'Youcef Boughrara',
        ]);

        $user->helpDesk()->create([

        ]);

        $user = User::create([
            'email' => 'a.medjadder@vitalcareprod.com',
            'password' => bcrypt('password'),
            'phone_number' => "0770271561",
            'role' => 'help desk',
            'name' => 'Aimen Medjadder',
        ]);

        $user->helpDesk()->create([

        ]);
    }
}
