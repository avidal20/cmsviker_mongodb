<?php

use Illuminate\Database\Seeder;
use App\Pqr_type;

class PqrTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Pqr_type::truncate();

    	$pqr_type = [
    		['type' => '1', 'name' => 'Petici&oacute;n'],
    		['type' => '2', 'name' => 'Queja o Reclamo']
    	];

    	foreach ($pqr_type as $pqr) {
    		Pqr_type::create($pqr);
    	}
    }
}
