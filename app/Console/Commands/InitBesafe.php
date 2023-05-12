<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitBesafe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:besafe_init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installing application for initial use. Powered by Kashif Khan';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('migrate:fresh');
        $this->call('db:seed', ['--class' => 'UserRolesAndPermissionSeeder']);
        $this->call('db:seed', ['--class' => 'DefaultUserSeeder']);
        $this->call('db:seed', ['--class' => 'MetaDataSeeder']);
    }
}