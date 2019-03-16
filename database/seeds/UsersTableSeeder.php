<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->state('admin')->create([
            'email' => 'admin@secret.test',
        ]);

        factory(User::class)->state('user')->create([
            'email' => 'user@secret.test',
        ]);
    }
}
