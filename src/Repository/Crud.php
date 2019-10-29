<?php

namespace  Andor9229\LaravelCrudGenerator\Repository;

use Illuminate\Support\Facades\File;

class Crud {

    protected $template;

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    public function makeDir($file = NULL)
    {
        File::makeDirectory(app_path($this->dir), $mode = 0777, true, true);
    }

    public function makeFile()
    {
        File::makeDirectory(app_path($this->dir . '/' .$this->file), $mode = 0777, true, true);
    }

    public function filePutContests()
    {
        file_put_contents(app_path($this->getPath()), $this->template);
    }

    public function dirAlreadyExists()
    {
        return File::exists(app_path($this->dir));
    }

    public function fileAlreadyExists()
    {
        return File::exists(app_path("../{$this->getPath()}"));
    }

    protected function getPath() {
        return $this->dir . '/'. $this->file;
    }
}
