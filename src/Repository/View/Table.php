<?php

namespace Andor9229\LaravelCrudGenerator\Repository\View;

use Andor9229\LaravelCrudGenerator\Repository\Crud;
use Illuminate\Support\Str;

class Table extends Crud
{
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = "../resources/views/pages/{$name}";
        $this->file = 'table.blade.php';
    }

    public function setTableTemplate()
    {
        $this->template = str_replace(
            [
                '{{modelName}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNamePluralLowerCase}}',
            ],
            [
                $this->name,
                Str::lower($this->name),
                Str::lower(Str::plural($this->name)),
            ],
            $this->getStub('views/table')
        );
    }
}
