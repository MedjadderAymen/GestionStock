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
            'email' => 'm.nebih@gmail.com',
            'password' => bcrypt('password'),
            'phone_number' => "0698281556",
            'role' => 'help desk',
            'name' => 'mehdi nabih',
        ]);

        $user->supervisor()->create([

        ]);
    }
}
