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

    private function createModel(){
        $model = Str::singular(Str::studly(class_basename($this->argument('name'))));
        $this->call('make:model', [
            'name' => "App\\Modules\\".trim($this->argument('name'))."\\Models\\$model",
        ]);
    }
    private function createMigration(){
        $table = Str::plural(Str::snake(class_basename($this->argument('name'))));
        try{
            $this->call('make:migration', [
                'name' => "create_{$table}_table",
                '--create' => $table,
                '--path' => "App\\Modules\\".trim($this->argument('name'))."\\Migrations",
            ]);
        } catch(\Exception $e){
            $this->error($e->getMessage());
        }

    }

    private function createController(){

    }

    private function createView(){

    }

    private function createApiController(){

    }

}
