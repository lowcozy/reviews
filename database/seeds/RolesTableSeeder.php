<?php


use Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		        $role = Sentinel::getRoleRepository()->createModel()->create([
				    'name' => 'Admin',
				    'slug' => 'admin',
				]);

				$role = Sentinel::getRoleRepository()->createModel()->create([
				    'name' => 'Collab',
				    'slug' => 'collab',
				]);

				$role = Sentinel::getRoleRepository()->createModel()->create([
				    'name' => 'Member',
				    'slug' => 'member',
				]);

				// tai khoan admin
				$credentials = [
				    'email'    => 'vietnga1910@gmail.com',
				    'password' => '2611td',
				    'first_name' => 'Viet',
				    'last_name' => 'Nga',
				];

				$user = Sentinel::registerAndActivate($credentials);

				$role = Sentinel::findRoleByName('Admin');

				$role->users()->attach($user);

				//tai khoan user binh thuong
				$credentials = [
				    'email'    => 'thang@gmail.com',
				    'password' => '2611td',
				    'first_name' => 'Toan',
				    'last_name' => 'Thang',
				];

				$user = Sentinel::registerAndActivate($credentials);

				$role = Sentinel::findRoleByName('Member');

				$role->users()->attach($user);

				//tai khoan collab
				$credentials = [
				    'email'    => 'minhthu@gmail.com',
				    'password' => '2611td',
				    'first_name' => 'Minh',
				    'last_name' => 'Thu',
				];

				$user = Sentinel::registerAndActivate($credentials);

				$role = Sentinel::findRoleByName('Collab');

				$role->users()->attach($user);
				
    }
}
