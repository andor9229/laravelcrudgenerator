<?php

namespace  Andor9229\LaravelCrudGenerator\Repository\View;

use Andor9229\LaravelCrudGenerator\Repository\Crud;
use Illuminate\Support\Str;

class Index extends Crud
{
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = "../resources/views/pages/{$name}";
        $this->file = 'index.blade.php';
    }

    public function setIndexTemplate()
    {
        $this->template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePlural}}',
                '{{modelNameLowerCase}}',
            ],
            [
                $this->name,
                Str::plural($this->name),
                Str::lower($this->name),
            ],
            $this->getStub('views/index')
        );
    }
}
