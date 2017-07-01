<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$webmaster = User::where('username',"webmaster")->first();
    	if(is_null($webmaster)){
			$user = new User();
			$user->username = "webmaster";  
			$user->id_number = "1143863035";
			$user->name = "Andres Felipe";
			$user->last_name = "Vidal Fernandez";
			$user->email = "soldider1621@gmail.com";
			$user->address = "Cr 11d 24 33";
			$user->number_phone = "3153659513";
			$user->state = "1";
			$user->admin = '0';
			$user->password = bcrypt("Yubarta2017");
			$user->save();
    	}
    }
}
