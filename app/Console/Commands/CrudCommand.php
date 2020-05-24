<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leito:crud {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create full laravel-admin CRUD';

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
        $name = $this->argument('name');

        // $this->apiController($name);
        $this->adminController($name);
        $this->model($name);

        // Add resource API routes
        // $apiRoutesLines = file(app_path('routes/api.php'));
        // array_pop($apiRoutesLines);
        // $apiRoutesContent = implode('', $apiRoutesLines);
        // file_put_contents(base_path('routes/api.php'), $apiRoutesContent . "\n\n\t" . 'Route::resource(\'' . $this->str_plural(strtolower($name)) . "', '{$name}Controller');");

        // Add resource laravel admin routes
        $adminRoutesLines = file(app_path('/Admin/routes.php'));
        array_pop($adminRoutesLines);
        $adminRoutesContent = implode('', $adminRoutesLines);
        file_put_contents(app_path('/Admin/routes.php'), $adminRoutesContent . "\n\t" . '$router->resource(\'' . $this->str_plural(strtolower($name)) . '\', ' . $name . 'Controller::class);' . PHP_EOL . '});' . PHP_EOL);
    }   

    protected function model($name)
    {
        $modelTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );

        file_put_contents(app_path("/Model/{$name}.php"), $modelTemplate);
    }

    protected function apiController($name)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower($this->str_plural($name)),
                strtolower($name)
            ],
            $this->getStub('ApiController')
        );

        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
    }

    protected function adminController($name)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePlural}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                $this->str_plural($name),
                strtolower($this->str_plural($name)),
                strtolower($name)
            ],
            $this->getStub('AdminController')
        );

        file_put_contents(app_path("/Admin/Controllers/{$name}Controller.php"), $controllerTemplate);
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function str_plural($str)
    {
        return $str . 's';
    }
}
