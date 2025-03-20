<?php

namespace Gii\ModuleOpnameStock\Commands;

class InstallMakeCommand extends EnvironmentCommand{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module-patient:install';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used for initial installation of module patient';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $provider = 'Gii\ModuleOpnameStock\ModulePatientServiceProvider';

        $this->comment('Installing Module Patient...');
        $this->callSilent('vendor:publish', [
            '--provider' => $provider,
            '--tag'      => 'config'
        ]);
        $this->info('✔️  Created config/module-opname-stock.php');

        $this->callSilent('vendor:publish', [
            '--provider' => $provider,
            '--tag'      => 'migrations'
        ]);
        $this->info('✔️  Created migrations');
        
        $migrations = $this->setMigrationBasePath(database_path('migrations'))->canMigrate();
        $this->callSilent('migrate', ['--path' => $migrations]);

        $this->info('✔️  App table migrated');

        $this->comment('gii/module-opname-stock installed successfully.');
    }
}