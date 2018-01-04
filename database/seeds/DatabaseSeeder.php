<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private $seeds = [];


    public function __construct()
    {
        $this->seeds = collect();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->requireSeeds();

        $this->seeds->each(function($class){
            $this->call($class);
        });
    }

    private function requireSeeds()
    {
        foreach (scandir(database_path('seeds')) as $file) {
            if (ends_with($file,'TableSeeder.php')) {
                require_once $file;
                $this->seeds->push('\\'.str_before($file,'.php'));
            }
        }
    }
}
