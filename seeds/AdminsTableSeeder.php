<?php

use Illuminate\Database\Seeder;

use App\Model\Menu;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
