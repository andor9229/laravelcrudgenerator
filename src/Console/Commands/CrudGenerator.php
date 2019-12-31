<?php

namespace Andor9229\LaravelCrudGenerator;

use Andor9229\LaravelCrudGenerator\Repository\View\Create;
use Andor9229\LaravelCrudGenerator\Repository\View\Index;
use Andor9229\LaravelCrudGenerator\Repository\View\Table;
use Andor9229\LaravelCrudGenerator\Repository\View\Trash;
use Andor9229\LaravelCrudGenerator\Repository\View\Update;
use Andor9229\LaravelCrudGenerator\Repository\Controller;
use Andor9229\LaravelCrudGenerator\Repository\Model;
use Andor9229\LaravelCrudGenerator\Repository\Route;
use Andor9229\LaravelCrudGenerator\Repository\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {name}';
    protected $name;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->name = $this->argument('name');

        $this->model();
        $this->controller();
        $this->request();
        $this->view();
        $this->route();
        $this->migration();

        $this->line('Done!');
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function view()
    {
        $this->tableView();
        $this->indexView();
        $this->trashView();
        $this->createView();
        $this->updateView();
    }

    private function tableView()
    {
        $table = new Table($this->name);

        $this->line('Creating View...');

        if($table->fileAlreadyExists()) {
            $this->warn("{$this->name} alredy exists");
            return;
        }

        try {
            // Table
            $table->setTableTemplate();
            $table->makeDir();
            $table->filePutContests();

            $this->info('Table View Created!');
        } catch (\Exception $e) {
            $this->error('Something went wrong!');
        }
    }

    private function indexView()
    {
        $index = new Index($this->name);

        $this->line('Creating Index View...');

        if($index->fileAlreadyExists()) {
            $this->warn("{$this->name} alredy exists");
            return;
        }

        try {
            // Table
            $index->setIndexTemplate();
            $index->makeDir();
            $index->filePutContests();

            $this->info('Index View Created!');
        } catch (\Exception $e) {
            $this->error('Something went wrong!');
        }
    }

    private function trashView()
    {
        $trash = new Trash($this->name);

        $this->line('Creating Trash View...');

        if($trash->fileAlreadyExists()) {
            $this->warn("{$this->name} alredy exists");
            return;
        }

        try {
            // Table
            $trash->setTrashTemplate();
            $trash->makeDir();
            $trash->filePutContests();

            $this->info('Trash View Created!');
        } catch (\Exception $e) {
            $this->error('Something went wrong!');
        }
    }

    private function createView()
    {
        $create = new Create($this->name);

        $this->line('Creating Create View...');

        if($create->fileAlreadyExists()) {
            $this->warn("{$this->name} alredy exists");
            return;
        }

        try {
            // Table
            $create->setCreateTemplate();
            $create->makeDir();
            $create->filePutContests();

            $this->info('Create View Created!');
        } catch (\Exception $e) {
            $this->error('Something went wrong!');
        }
    }

    private function updateView()
    {
        $update = new Update($this->name);

        $this->line('Creating Create View...');

        if($update->fileAlreadyExists()) {
            $this->warn("{$this->name} alredy exists");
            return;
        }

        try {
            // Table
            $update->setUpdateTemplate();
            $update->makeDir();
            $update->filePutContests();

            $this->info('Create View Created!');
        } catch (\Exception $e) {
            $this->error('Something went wrong!');
        }
    }

    protected function model()
    {
        $model = new Model($this->name);
        $this->line('Creating Model...');

        if($model->fileAlreadyExists()) {
            $this->warn("{$this->name} alredy exists");
            return;
        }

        try {
            if(! $model->dirAlreadyExists()) {
                $model->makeDir();
            }

            $model->setModelTemplate();
            $model->filePutContests();
            $this->info('Model Created!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            $this->error('Something went wrong!');
        }
    }

    protected function controller()
    {
        $controller = new Controller($this->name);
        $this->line('Creating Controller...');

        if($controller->fileAlreadyExists()) {
            $this->warn("{$this->name}Controller already exists!");
            return;
        }

        try {
            $controller->setControllerTemplate();
            $controller->filePutContests();

            $this->info($this->name . 'Controller created!');
        } catch (\Exception $e) {
            $this->error('Something went wrong!');
        }
    }

    protected function request()
    {
        $request = new Request($this->name);
        $this->line('Creating Request...');

        if($request->fileAlreadyExists()) {
            $this->warn("{$this->name} already exists");
            return;
        }

        try {
            if(! $request->dirAlreadyExists()) {
                $request->makeDir();
            }

            $request->setRequestTemplate();
            $request->filePutContests();
            $this->info('Model Created!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            $this->error('Something went wrong!');
        }
    }

    protected function migration()
    {
        $migration = "create_" . Str::plural(Str::lower($this->name)) . "_table";

        try {
            $this->line('Creating Migration...');
            Artisan::call("make:migration $migration");
            $this->info($this->name . 'Migration created!');
        } catch (\InvalidArgumentException $e) {
            $this->error('Something went wrong!');
        }
    }

    protected function route()
    {
        $this->line('Creating Route...');
        $route = new Route($this->name);

        if($route->routeAlreadyPresent()) {
            $this->warn('Route is already exists');
            return;
        }

        try {
            if(! $route->fileAlreadyExists()) {
                $route->makeCrudFile();
                $route->includeCrudFile();
            }

            $route->appendRoutes();
            $this->info('Route created!');
        } catch (\Exception $e) {
            $this->error('Something went wrong');
        }
    }
}
