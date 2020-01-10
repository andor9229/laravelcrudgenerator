<?php

namespace Andor9229\LaravelCrudGenerator\Repository;

use Illuminate\Support\Str;

class Controller extends Crud
{
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = 'Http/Controllers';
        $this->file = "{$name}Controller.php";
    }

    public function setControllerTemplate()
    {
        $this->template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
            ],
            [
                $this->name,
                Str::lower(Str::plural($this->name)),
                Str::lower($this->name),
            ],
            $this->getStub('controller')
        );
    }
}
