<?php

use Illuminate\Database\Seeder;
use App\User;
use App\AccessLevel;
use App\Directorate;
use App\UserStatus;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $accessLevel = AccessLevel::firstOrCreate([
            'level' => 'low level',
            'level_number' => 0
        ]);

        $directorate = Directorate::firstOrCreate([
            'name' => 'ICT',
            'description' => 'Information Communication Technology',
            'contact' => '+2519000000',
            'manager' => 'Obo Guta',
        ]);

        $userStatus = UserStatus::firstOrCreate([
            'status' => 'active'
        ]);

        $role = Role::firstOrCreate(['name' => 'admin']);
        $permission = Permission::firstOrCreate(['name' => strtolower('all')]);
        Permission::firstOrCreate(['name' => strtolower('manage knowledge')]);
        Permission::firstOrCreate(['name' => strtolower('manage directorate')]);
        $role->givePermissionTo($permission);

        $user = User::create([
            'name' => 'Obo Guta',
            'email' => 'guta@gmail.com',
            'password' => Hash::make('password'),
            'directorate_id' => $directorate->id,
            'job_title' => 'ICT Administrator',
            'phone' => '+2519000000',
            'photo' => 'nofile.jpg',
            'username' => 'administrator',
            'user_status_id' => $userStatus->id,
            'access_level_id' => $accessLevel->id,
        ]);

        $user->assignRole($role->name);
    }
}
