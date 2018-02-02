<?php
/**
 * Created by PhpStorm.
 * User: tangkeyu<charlestide@vip.163.com>
 * Date: 2018/2/1
 * Time: 下午1:33
 */

namespace Charlestide\Paladin\Command;

use Charlestide\Paladin\Seeder\SystemSeeder;
use Illuminate\Console\Command;

class Seed extends Command
{

    protected $signature = 'paladin:seed';

    protected $description = 'run seeder for paladin system initialize';

    public function handle() {
        $systemSeeder = new SystemSeeder();
        $systemSeeder->run();
        $this->info('Seeder has been run.');
    }
}