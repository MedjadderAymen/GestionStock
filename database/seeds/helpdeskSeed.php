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
            'email' => 'm.nebih@vitalcareprod.com',
            'password' => bcrypt('Dev@2021'),
            'phone_number' => "0770169703",
            'role' => 'help desk',
            'name' => 'Mahdi Nebih',
        ]);

        $user->helpDesk()->create([

        ]);

        $user = User::create([
            'email' => 'y.bougherara@vitalcareprod.com',
            'password' => bcrypt('Dev@2021'),
            'phone_number' => "0770249933",
            'role' => 'help desk',
            'name' => 'Youcef Boughrara',
        ]);

        $user->helpDesk()->create([

        ]);

        $user = User::create([
            'email' => 'a.medjadder@vitalcareprod.com',
            'password' => bcrypt('Dev@2021'),
            'phone_number' => "0770271561",
            'role' => 'help desk',
            'name' => 'Aimen Medjadder',
        ]);

        $user->helpDesk()->create([

        ]);
    }
}
