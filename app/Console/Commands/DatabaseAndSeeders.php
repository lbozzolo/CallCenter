<?php

namespace SmartLine\Console\Commands;

use Illuminate\Console\Command;

class DatabaseAndSeeders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:seeders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecuta un refresh de la base de datos, ejecuta los seeders y los FakerSeeders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('migrate:refresh', [
            '--seed' => 'default'
        ]);

        $this->call('db:seed', [
            '--class' => 'FakerSeeders'
        ]);

    }
}
