<?php

use App\Models\UserRole;
use App\Models\UserType;
use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            UserRole::create([
                'email' => $user->email,
                'type_id' => UserType::SUPER_ADMIN,
                'campus_id' => $user->campus_id ?? 1,
            ]);
        }
    }
}
