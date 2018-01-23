<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Charlestide\Paladin\ClassParser\Parser\ModelParser;

class PermissionTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parser = new ModelParser('src/Models');
        $classResults = $parser->parsePath();

        foreach ($classResults as $classResult) {
            foreach (['create','update','view','browse','delete'] as $action) {
                self::createPermission(
                    $classResult->getDisplayName(),
                    $classResult->getClassName(),
                    $action,
                    '允许对 '.$classResult->getDisplayName().' '.$action
                );
            }
        }

    }

    public static function createPermission(string $name,string $object,string $action,string $description = null) {
        return DB::table('permissions')->insertGetId([
            'name' => $name,
            'object' => $object,
            'action' => $action,
            'description' => $description
        ]);
    }

}
