<?php


namespace Andor9229\LaravelCrudGenerator\Repository\View;

use Andor9229\LaravelCrudGenerator\Repository\Crud;
use Illuminate\Support\Str;

class Trash extends Crud
{
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = "../resources/views/pages/config/{$name}";
        $this->file =  "trash.blade.php";
    }

    public function setTrashTemplate()
    {
        $this->template = str_replace(
            [
                '{{modelName}}',
                '{{modelNameLowerCase}}',
            ],
            [
                $this->name,
                Str::lower($this->name),
            ],
            $this->getStub('views/trash')
        );
    }

}
