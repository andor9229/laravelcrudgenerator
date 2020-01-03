<?php


namespace  Andor9229\LaravelCrudGenerator\Repository\View;

use Andor9229\LaravelCrudGenerator\Repository\Crud;
use Illuminate\Support\Str;

class Show extends Crud
{
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = "../resources/views/pages/{$name}";
        $this->file =  "show.blade.php";
    }

    public function setShowTemplate()
    {
        $this->template = str_replace(
            [
                '{{modelName}}',
                '{{modelNameSingular}}',
                '{{modelNameSingularLowerCase}}',
            ],
            [
                $this->name,
                Str::singular($this->name),
                Str::singular(Str::lower($this->name)),
            ],
            $this->getStub('views/show')
        );
    }

}
