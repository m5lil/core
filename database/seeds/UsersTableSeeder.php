<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mahmoud Khalil',
            'email' => 'mkhlil1288@gmail.com',
            'password' => bcrypt('123qweasdzxc'),
            'activated' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
