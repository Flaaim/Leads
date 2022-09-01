<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ModuleMake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}
                                        {--all} 
                                        {--model}
                                        {--migration}
                                        {--controller}
                                        {--api}
                                        {--view}
                                        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->option('all')){
            $this->input->setOption('model', true);
            $this->input->setOption('migration', true);
            $this->input->setOption('controller', true);
            $this->input->setOption('api', true);
            $this->input->setOption('view', true);
        }
        if($this->option('model')){
            $this->createModel();
        }
        if($this->option('migration')){
            $this->createMigration();
        }
        if($this->option('controller')){
            $this->createController();
        }
        if($this->option('api')){
            $this->createApiController();
        }
        if($this->option('view')){
            $this->createView();
        }
    }


}
