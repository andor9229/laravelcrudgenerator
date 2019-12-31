<?php


namespace Andor9229\LaravelCrudGenerator\Repository\View;

use Andor9229\LaravelCrudGenerator\Repository\Crud;
use Illuminate\Support\Str;

class Update extends Crud
{
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = "../resources/views/pages/{$name}";
        $this->file =  "update.blade.php";
    }

    public function setUpdateTemplate()
    {
        $this->template = str_replace(
            [
                '{{modelNameLowerCase}}',
            ],
            [
                Str::lower($this->name),
            ],
            $this->getStub('views/update')
        );
    }

}
