<?php

namespace  Andor9229\LaravelCrudGenerator\Repository;

class Model extends Crud {
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = "Models/{$name}";
        $this->file = "{$name}.php";
    }

    public function setModelTemplate()
    {
        $this->template = str_replace(
            ['{{modelName}}'],
            [$this->name],
            $this->getStub('model')
        );
    }
}
