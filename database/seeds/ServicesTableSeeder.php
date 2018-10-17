<?php

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
        	'Wifi',
			'Reservation',
			'Events',
			'Host',
			'Gaming',
			'Event',
			'ParkCenter'
        );

        foreach ($data as $item) {
        	 Service::create([
	           'name' => $item
	        ]);
        }
    }
}
