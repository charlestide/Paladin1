<?php

use Illuminate\Database\Seeder;


class AdminsTableSeeder extends Seeder
{



    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!DB::table('admins')->where('name','admin')->count()) {
            DB::table('admins')->insert([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
