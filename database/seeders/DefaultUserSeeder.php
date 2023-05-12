<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userNames = [
            'level_1',
            'level_2',
            'level_3',
            'admin'
        ];
        foreach ($userNames as $name) {
            $user = $this->createUser($name);
            if ($user) {
                // assign role
                $user->syncRoles($name);
            }
        }
    }

    public function createUser($username)
    {
        $user = User::where('first_name', $username)->first();
        if ($user)
            return;
        $user = User::create([
            'first_name' => $username,
            'last_name' => $username,
            'email' => $username . '@besafe.com',
            'password' => Hash::make('password'),
            'status' => 1,
            'email_verified_at' => Carbon::now(),
        ]);
        return $user;
    }
}