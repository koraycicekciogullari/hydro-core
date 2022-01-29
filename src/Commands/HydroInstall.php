<?php

namespace Koraycicekciogullari\HydroCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Koraycicekciogullari\HydroAdministrator\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HydroInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hydro:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hydro Bulk Data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->call('migrate:fresh');
        $this->info('DB Migration Successful');
        $permissions = [
            'permission index',
            'permission store',
            'permission show',
            'permission update',
            'permission destroy',
            'role index',
            'role store',
            'role show',
            'role update',
            'role destroy',
            'administrator index',
            'administrator store',
            'administrator show',
            'administrator update',
            'administrator destroy',
            'socialmedia index',
            'socialmedia store',
            'socialmedia show',
            'socialmedia update',
            'socialmedia destroy',
            'slider index',
            'slider store',
            'slider show',
            'slider update',
            'slider destroy',
            'page index',
            'page store',
            'page show',
            'page update',
            'page destroy',
            'contact index',
            'contact show',
            'contact destroy',
        ];

        $roles = [
            'root',
            'admin',
        ];

        foreach ($permissions as $permission){
            Permission::create(['name' => $permission, 'guard_name' => 'sanctum']);
        }
        $this->info('Permission Creating Successful');
        foreach ($roles as $role){
            Role::create(['name' => $role, 'guard_name' => 'sanctum']);
        }
        $this->info('Role Creating Successful');
        User::query()->create([
            'name'              => 'Koray Çiçekçioğulları',
            'email'             => 'k.cicekciogullari@gmail.com',
            'email_verified_at'  => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ]);
        User::find(1)->assignRole('root');
        $this->info('User Creating Successful');
    }
}
