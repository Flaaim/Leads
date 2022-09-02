<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

class ModuleMake extends Command
{

    private $files;

    public function __construct(Filesystem $filesystem){
        parent::__construct();
        $this->files = $filesystem;
    }
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
        $controller = Str::studly(class_basename($this->argument('name')));
        $modelName = Str::singular(Str::studly(class_basename($this->argument('name'))));
        $path = $this->getControllerPath($this->argument('name'));
        if($this->alreadyExists($path)){
            $this->error('Controller already exists');
        } else {
            $this->makeDirectory($path);

            $stub = $this->files->get(base_path('/resources/stubs/controller.model.api.stub'));
            
            $stub = str_replace(
                [
                    'DummyNamespace',
                    'DummyRootNamespace',
                    'DummyClass',
                    'DummyArgument',
                    'DummyModel',
                    'model',
                ],
                [
                    "App\\Modules\\".trim(str_replace("/", "\\", $this->argument('name')))."\\Controllers",
                    $this->laravel->getNamespace(),
                    $controller."Controller",
                    trim(str_replace("/", "\\", $this->argument('name'))),
                    $modelName,
                    Str::lower($modelName),
                ],
                $stub
            );
            $this->files->put($path, $stub);
            $this->info("Controller created successfully.");
            $this->createRoutes($controller, $modelName);
        }

    }

    private function createView(){
        $viewsPath = $this->getViewsPath($this->argument('name'));
        
        foreach($viewsPath as $path){
            if($this->alreadyExists($path)){
                $this->error("View already exixts");
            } else {
                $this->makeDirectory($path);
                $stub = $this->files->get(base_path('resources/stubs/view.stub'));
                $stub = str_replace(
                    [''],
                    [],
                    $stub
                );
                $this->files->put($path, $stub);
                $this->info("View created succesfully");
            }
        }
       
    }

    private function createApiController(){
        $apiController = Str::studly(class_basename($this->argument('name')));
        $modelName = Str::singular(Str::studly(class_basename($this->argument('name'))));
        $path = $this->getApiControllerPath($this->argument('name'));

        if($this->alreadyExists($path)){
            $this->error('ApiController already exists');
        }else {
            $this->makeDirectory($path);
            $stub = $this->files->get(base_path('/resources/stubs/controller.model.api.stub'));
            $stub = str_replace(
                [
                    'DummyNamespace',
                    'DummyRootNamespace',
                    'DummyClass',
                    'DummyArgument',
                    'DummyModel',
                    'model',
                ],
                [
                    "App\\Modules\\".trim(str_replace("/", "\\", $this->argument('name')))."\\Controllers\\Api",
                    $this->laravel->getNamespace(),
                    $apiController."Controller",
                    trim(str_replace("/", "\\", $this->argument('name'))),
                    $modelName,
                    Str::lower($modelName),
                ],
                $stub
            );
            $this->files->put($path, $stub);
            $this->info("ApiController created successfully.");
            $this->createApiRoutes($apiController, $modelName);
        }
    }
    private function createApiRoutes($apiController, $modelName){
       $routesPath = $this->getApiRoutesPath($this->argument('name')); 

       if($this->alreadyExists($routesPath)){
            $this->error("Routes already exists");
       } else {
            $this->makeDirectory($routesPath);

            $stub = $this->files->get(base_path('/resources/stubs/routes.api.stub'));
            $stub = str_replace(
                [                    
                    'DummyArgument',
                    'DummyClass',
                    'DummyRoutePrefix',
                    'DummyModelVariable',
                ],
                [
                    trim(str_replace("/", "\\", $this->argument('name'))),
                    $apiController."Controller",
                    Str::plural(Str::snake(lcfirst($modelName))),
                    Str::snake(lcfirst($modelName)),

                ],
                $stub
            );
            $this->files->put($routesPath, $stub);
            $this->info('Routes created successfully');
       }
    }
    private function createRoutes($controller, $modelName){
        $routesPath = $this->getRoutesPath($this->argument('name'));

        if($this->alreadyExists($routesPath)){
            $this->error('Routes already exists');
        } else {
            $this->makeDirectory($routesPath);
            $stub = $this->files->get(base_path('/resources/stubs/routes.web.stub'));
            $stub = str_replace(
                [
                    'DummyArgument',
                    'DummyClass',
                    'DummyRoutePrefix',
                    'DummyModelVariable',
                ],
                [
                    trim(str_replace("/", "\\", $this->argument('name'))),
                    $controller."Controller",
                    Str::plural(Str::snake(lcfirst($modelName))),
                    Str::snake(lcfirst($modelName)),

                ], 
                $stub);
            $this->files->put($routesPath, $stub);
            $this->info('Routes created successfully');
        }
    }
    private function getRoutesPath($name){
        return $this->laravel['path']."/Modules/".str_replace('\\', '/', $name)."/Routes/web.php";
    }
    private function getApiRoutesPath($name){
        return $this->laravel['path']."/Modules/".str_replace('\\', '/', $name)."/Routes/api.php";
    }
    private function getControllerPath($argument){
        $controller = Str::studly(class_basename($argument));
        return $this->laravel['path'].'/Modules/'.str_replace("\\", '/', $argument).'/Controllers/'.$controller."Controller.php";
    }

    private function getApiControllerPath($argument){
        $apiController = Str::studly(class_basename($argument));
        return $this->laravel['path']."/Modules/".str_replace("\\", "/", $argument)."/Controllers/Api/".$apiController."Controller.php";
    }
    private function getViewsPath($name){
        $views = collect([
            'index',
            'create',
            'edit',
            'show',
        ]);
        $viewsPath = $views->map(function ($item) use($name){
            return base_path("/resources/views/".str_replace('\\', '/',$name).'/'.$item.".blade.php");
        });
        return $viewsPath;
    }
    private function alreadyExists($path){
        return $this->files->exists($path);
    }

    private function makeDirectory($path){
        if(!$this->files->isDirectory(dirname($path))){
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
        return $path;
    }






}
