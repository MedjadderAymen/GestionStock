<?php

use App\User;
use Illuminate\Database\Seeder;

class supervisorSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'y.achir@vitalcareprod.com',
            'password' => bcrypt('password'),
            'phone_number' => "0770526333",
            'role' => 'supervisor',
            'name' => 'Yasmine Achir',
        ]);

        $user->supervisor()->create([

        ]);
    }
}
