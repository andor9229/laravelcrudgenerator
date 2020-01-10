<?php

namespace  Andor9229\LaravelCrudGenerator\Repository;

class Request extends Crud
{
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = "Http/Requests/{$name}";
        $this->file = "{$name}Request.php";
    }

    public function setRequestTemplate()
    {
        $this->template = str_replace(
            [
                '{{modelName}}',
            ],
            [
                $this->name,
            ],
            $this->getStub('request')
        );
    }
}
