<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ModularProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $modules = config('modular.modules');
        $path = config('modular.path');

        if($modules){
            Route::group(['prefix'=> ''], function() use($path, $modules) {
                foreach($modules as $mod => $submodules){
                    foreach($submodules as $sub){
                        $relativePath = "/$mod/$sub";  
                            Route::middleware('web')
                            ->group(function() use($mod, $sub, $path, $relativePath){
                                $this->getWebRoutes($mod, $sub, $path, $relativePath);
                            });
    
                            Route::middleware('api')
                            ->prefix('api')
                            ->group(function() use($mod, $sub, $path, $relativePath){
                                $this->getApiRoutes($mod, $sub, $path, $relativePath);
                            });
 
                    }
                }
            });

        }
    }

    private function getWebRoutes($mod, $sub, $path, $relativePath){
        $routesPath = $path.$relativePath."/Routes/web.php";

        if(file_exists($routesPath)){
            if($mod != config('modular.groupWithoutPrefix')){
                Route::group([
                    'prefix'=>strtolower($mod),
                    'middleware' => $this->getMiddleware($mod),
                ], function() use($mod, $sub, $routesPath){
                    Route::namespace("App\\Modules\\$mod\\$sub\\Controllers")->group($routesPath);
                });
            } else {
                Route::namespace("App\\Modules\\$mod\\$sub\\Controllers")->middleware($this->getMiddleware($mod))->group($routesPath);
            }
        }
    }
    private function getApiRoutes($mod, $sub, $path, $relativePath){
        $routesPath = $path.$relativePath."/Routes/api.php";

        if(file_exists($routesPath)){
            Route::group([
                'prefix'=>strtolower($mod),
                'middleware' => $this->getMiddleware($mod, 'api'),
            ], function() use($mod, $sub, $routesPath){
                Route::namespace("App\\Modules\\$mod\\$sub\\Controllers")->group($routesPath);
            });
        }
    }


    private function getMiddleware($mod, $type = 'web'){
        $middleware = [];

        $config = config('modular.groupMiddleware');
        if(isset($config[$mod])){
            if(array_key_exists($type, $config[$mod])){
                $middleware = array_merge($middleware, $config[$mod][$type]);
            }
        }
        return $middleware;
    }
}
