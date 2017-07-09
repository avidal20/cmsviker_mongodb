<?php

use Illuminate\Database\Seeder;
use App\User;
use Ultraware\Roles\Models\Role;
use Ultraware\Roles\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$user = User::where('username',"webmaster")->first();

    	if(is_null($user)){
  			$user = new User();
  			$user->username = "webmaster";  
  			$user->id_number = "1143863035";
  			$user->name = "Andres Felipe";
  			$user->last_name = "Vidal Fernandez";
  			$user->email = "soldider1621@gmail.com";
  			$user->address = "Cr 11d 24 33";
  			$user->number_phone = "3153659513";
  			$user->state = "1";
  			$user->admin = '1';
  			$user->password = bcrypt("Yubarta2017");
  			$user->save();
      }

			$roles = [
				'category' => ['all' => 'on'],
				'sizes' => ['all' => 'on'],
				'colors' => ['all' => 'on'],
				'products' => ['all' => 'on'],
				'kids' => ['all' => 'on'],
				'groups' => ['all' => 'on'],
				'users' => ['all' => 'on'],
			];

			foreach ($roles as $module => $rol) {
          $rolModule = Role::where('name',$module.".module")->first();
          if(is_null($rolModule)){
            $rolModule = Role::Create([
                  'name' => $module.".module",
                  'slug' => $module.".module",
            ]);

            $roles[] = $rolModule->id;
          }else{
            $rolModule = Role::where('name',$module.".module")->first();
            $roles[] = $rolModule->id;
          }

          $roles[] = $rolModule->id;

        foreach ($rol as $key => $value) {
          $rol = Role::where('name',$module.".".$key)->first();
          if(is_null($rol)){

            $rol = Role::Create([
                'name' => $module.".".$key,
                'slug' => $module.".".$key,
            ]);

            $roles[] = $rol->id;

          }else{
            $rol = Role::where('name',$module.".".$key)->first();
            $roles[] = $rol->id;
          }
        }
      }

      $user->syncRoles($roles);
    }
}
