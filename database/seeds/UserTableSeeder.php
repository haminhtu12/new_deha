<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                $user = new User;
                $user->name = 'Skipperhoa';
                $user->email = 'skipperhoa@hoanguyenit.com';
                $user->password = bcrypt('12345678');
	            $user->save();
	            $user->roles()->attach(Role::where('name', 'user')->first());

	            $admin = new User;
	            $admin->name = 'hoa123';
                $admin->email = 'hoa123@hoanguyenit.com';
                $admin->password = bcrypt('hoa12345678');
                $admin->save();
	            $admin->roles()->attach(Role::where('name', 'admin')->first());
    }
}
