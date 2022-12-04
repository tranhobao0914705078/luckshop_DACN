<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();

        $adminRoles = Roles::where('name', 'admin')->first();
        $authnRoles = Roles::where('name', 'author')->first();
        $userRoles = Roles::where('name', 'user')->first();

        $admin = Admin::create([
            'admin_name' => 'admin',
            'admin_email' => 'admin1@gmail.com',
            'admin_phone' => '0123456789',
            'admin_password' => md5('113520')
        ]);
        $author = Admin::create([
            'admin_name' => 'author',
            'admin_email' => 'author1@gmail.com',
            'admin_phone' => '0123456789',
            'admin_password' => md5('113520')
        ]);
        $user = Admin::create([
            'admin_name' => 'user',
            'admin_email' => 'user1@gmail.com',
            'admin_phone' => '0123456789',
            'admin_password' => md5('113520')
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authnRoles);
        $user->roles()->attach($userRoles);
    }
}
