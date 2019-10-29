<?php


namespace  Andor9229\LaravelCrudGenerator\Repository\View;

use Andor9229\LaravelCrudGenerator\Repository\Crud;
use Illuminate\Support\Str;

class Create extends Crud
{
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = "../resources/views/pages/config/{$name}";
        $this->file =  "create.blade.php";
    }

    public function setCreateTemplate()
    {
        $this->template = str_replace(
            [
                '{{modelNameLowerCase}}',
            ],
            [
                Str::lower($this->name),
            ],
            $this->getStub('views/create')
        );
    }

}
