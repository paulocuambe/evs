<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Paulo Cuambe',
            'username' => 'pcuambe',
            'email' => 'pcuambe@inove.it',
            'password' => \bcrypt('$ecr3tAcce$$'),
            'role' => 'super_admin'
        ]);
    }
}
