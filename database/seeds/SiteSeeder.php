<?php

use App\site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        site::create([
            'address' => 'Bir Khadem, siège'
        ]);
        site::create([
            'address' => 'Baba Ali, usine'
        ]);
        site::create([
            'address' => 'Baba Ali, bloc administratif'
        ]);
        site::create([
            'address' => 'Baba Ali, centre de distribution'
        ]);
    }
}
