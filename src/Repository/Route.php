<?php

namespace  Andor9229\LaravelCrudGenerator\Repository;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Route extends Crud
{
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = "{$name}";
        $this->dir = 'routes';
        $this->file = 'crud.php';
    }

    public function routeAlreadyPresent()
    {
        $routes = \Illuminate\Support\Facades\Route::getRoutes()->getRoutes() ;
        foreach ($routes as $index => $route) {
            if($route->action['namespace'] === 'App\Http\Controllers' && \Illuminate\Support\Arr::has($route->action, 'controller')) {
                $name = \Illuminate\Support\Str::replaceFirst('App\Http\Controllers\\', '', $route->action['controller']);
                $name = explode('@', $name)[0];
                if($name === "{$this->name}Controller") {
                    return true;
                }
            }
        }

        return false;
    }

    public function makeCrudFile()
    {
        File::append(base_path($this->getPath()), "<?php\n\n");
    }

    public function includeCrudFile()
    {
        File::append(base_path($this->dir . "/web.php"), "@include('crud.php')");
    }

    public function appendRoutes()
    {
        $name = Str::lower($this->name);
        $data =
            "Route::group(['prefix' => \"{$name}\", 'as' => \"{$name}.\"], function () {\n" .
            "\tRoute::get('', '{$this->name}Controller@index')->name('index');\n" .
            "\tRoute::get(\"{{$name}}/edit/\", \"{$this->name}Controller@edit\")->name('edit');\n" .
            "\tRoute::get(\"new\", \"{$this->name}Controller@create\")->name('new');\n" .
            "\tRoute::get(\"{id}/restore\", \"{$this->name}Controller@restore\")->name('restore');\n" .
            "\tRoute::get(\"trash\", \"{$this->name}Controller@trash\")->name('trash');\n" .
            "\tRoute::post(\"\", \"{$this->name}Controller@store\")->name('store');\n" .
            "\tRoute::patch(\"{{$name}}\", \"{$this->name}Controller@update\")->name('update');\n" .
            "\tRoute::delete(\"{{$name}}\", \"{$this->name}Controller@delete\")->name('delete');\n" .
            "\tRoute::delete(\"{id}/destroy\", \"{$this->name}Controller@destroy\")->name('destroy');\n" .
            "});\n";

        File::append(base_path($this->getPath()), $data);
    }

}
