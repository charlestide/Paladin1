<?php
/**
 * Created by PhpStorm.
 * User: tangkeyu<charlestide@vip.163.com>
 * Date: 2018/2/2
 * Time: 下午9:48
 */

namespace Charlestide\Paladin\Command;


use Charlestide\Paladin\PaladinServiceProvider;
use Charlestide\Paladin\Util\StyledOutput;
use Illuminate\Console\Command;
use Spatie\Permission\PermissionServiceProvider;

class Install extends Command
{
    use StyledOutput;

    protected $signature = 'paladin:install {--force : overrite files if they are exists}';

    protected $description = 'Paladin Admin Installer';

    private $step = 1;

    private $path = null;

    public function handle() {

        $this->alert('Paladin Admin Installion');
        $this->env();

        $this->step('Clear Dirty Files');
        $this->clear();

        $this->step('Publish migrations By Spatie\Permissions');
        $this->publishPermissions('migrations');

        $this->step('Publish config By Spatie\Permissions');
        $this->publishPermissions('config');

        $this->step('Publish config By Charlestide/Paladin ');
        $this->publishPaladin('config',true);

        $this->step('Publish migrations By Charlestide/Paladin ');
        $this->publishPaladin('migrations');

        $this->step('Publish assets By Charlestide/Paladin ');
        $this->publishPaladin('assets',true);

        $this->step('Publish Language Files By Charlestide/Paladin ');
        $this->publishPaladin('lang',true);

        $this->step('Generate Passport Key');
        $this->call('passport:keys');

        $this->step('Install NPM Dependencies');
        $this->npmInstall();

        $this->step('Run Migrations');
        $this->call('migrate');

        $this->step('Run Seeds');
        $this->call('paladin:seed');

        $this->step('Generate Perload Mapping File');
        passthru('./node_modules/.bin/preload');

        $this->step('Compile Assets');
        passthru('npm run dev');

        if ($this->confirm('Would you like create a Super Admin User?',true)) {

            $email = $this->ask('What is the Email of Super Admin User?','admin@admin.com');
            $password = $this->secret('What is the Password?',true);

            $this->call('paladin:superadmin',[
                'email' => $email,
                'password' => $password
            ]);
        }
    }

    private function publishPermissions(string $tag,bool $force = false) {
        $this->publish(PermissionServiceProvider::class,$tag,$force);
    }

    private function publishPaladin(string $tag,bool $force = false) {
        $this->publish(PaladinServiceProvider::class,$tag,$force);
    }

    private function publish(string $provider,string $tag,bool $force = false) {
        $args = [
            '--provider' => $provider,
            '--tag' => $tag
        ];
        if ($force || $this->option('force')) {
            $args['--force'] = true;
        }
        $this->call('vendor:publish',$args);
    }

    private function npmInstall() {
        $cmd = 'npm install ';
        $dev = [
            'lodash-webpack-plugin',
            'webpack',
            'clean-webpack-plugin',
            'popper.js',
            'babel-plugin-syntax-jsx',
            'babel-plugin-transform-vue-jsx',
            'babel-plugin-transform-runtime',
            'laravel-mix',
            'babel-plugin-syntax-dynamic-import'
        ];

        $prod = [
            'vue-router',
            'vue',
            'vuex',
            'bootstrap',
            'element-ui',
            'paladin-vue'
        ];

        $command = $cmd . implode(' ',$dev).' --save-dev';
        $this->line($command);
        passthru($command);

        $command = $cmd . implode(' ',$prod).' --save';
        $this->line($command);
        passthru($command);

//        passthru('npm install ../../Charlestide/Paladin-vue/');

        passthru('npm install');
    }

    private function clear() {
        $names = [
            'create_paladin_tables.php',
            'create_permission_tables.php',
        ];

        $files = scandir($this->getPath('/database/migrations/'));

        foreach ($files as $file) {
            $result = null;

            if (ends_with($file,$names)) {
                $file = $this->getPath('/database/migrations/'.$file);
                $this->info("Deleting File ", false);
                $this->warn("[$file] ");
                if (unlink($file)) {
                    $this->success('Deleted', true);
                } else {
                    $this->failure('Failured', true);
                }
            }
        }
    }

    private function step(string $name) {
        $this->alert('Step ('. $this->step++.') '.$name);
    }

    private function env() {
        $this->table(['Name','Value'],[
            ['Path',$this->getPath()]
        ]);
    }

    private function getPath(string $path = null) {
        if (!$this->path) {
            ob_start();
            $this->path = system('pwd');
            ob_end_clean();
        }
        return $this->path.$path;
    }
}