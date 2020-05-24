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
    protected $signature = 'leito:crud {model} {--attributes=}';

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
        $modelName = $this->argument('model');

        $attributes = collect(explode(';', $this->option('attributes')));

        $this->createModel($modelName, $attributes);

        $this->createAdminController($modelName, $attributes);

        // $this->createApiController($modelName);

        $this->createMigration($modelName, $attributes);

        $this->createAdminResourceRoutes($modelName);

        // $this->createApiResourceRoutes($modelName);

        $this->call('migrate');
    }

    protected function createModel($modelName, $attributes)
    {
        $stub = $stub = $this->getStubReplaced('Model', $modelName);

        $formatedAttributes = $attributes->map(function ($attribute) {
            $attributeName = collect(explode(':', $attribute))[0];
            return "'" . trim($attributeName) . "'";
        });

        $stub = str_replace('{{attributes}}', $formatedAttributes->implode(',' . PHP_EOL . "\t\t"), $stub);

        file_put_contents(app_path("/Model/{$modelName}.php"), $stub);
    }

    protected function createAdminController($modelName, $attributes)
    {
        $stub = $this->getStubReplaced('AdminController', $modelName);

        $formatedAttributes = $this->getFormattedAttributes($attributes);

        $tableColumns = $formatedAttributes->map(function ($attribute) {
            $field = '';
            if ($attribute['type'] == 'image') {
                $field = '$grid->column(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))->image(null, null, 100)';
            } else {
                $field = '$grid->column(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))';
            }

            return $field . ';';
        });

        $detailFields = $formatedAttributes->map(function ($attribute) {
            $field = '';
            if ($attribute['type'] == 'image') {
                $field = '$show->field(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))->image()';
            } else {
                $field = '$show->field(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))';
            }

            return $field . ';';
        });

        $formFields = $formatedAttributes->map(function ($attribute) {
            $field = '';
            if ($attribute['type'] == 'integer') {
                $field .= '$form->number(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))';
            } else if ($attribute['type'] == 'text') {
                $field .= '$form->textarea(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))';
            } else if ($attribute['type'] == 'select') {
                $field .= '$form->select(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))->options([])';
            } else if ($attribute['type'] == 'multipleSelect') {
                $field .= '$form->multipleSelect(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))->options([])';
            } else if ($attribute['type'] == 'radios') {
                $field .= '$form->radio(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))->options([])';
            } else if ($attribute['type'] == 'checks') {
                $field .= '$form->checkbox(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))->options([])';
            } else if ($attribute['type'] == 'email') {
                $field .= '$form->email(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))';
            } else if ($attribute['type'] == 'password') {
                $field .= '$form->password(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))';
            } else if ($attribute['type'] == 'mobile') {
                $field .= '$form->mobile(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))->options([\'mask\' => \'999 9999 9999\'])';
            } else if ($attribute['type'] == 'color') {
                $field .= '$form->color(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))';
            } else if ($attribute['type'] == 'time') {
                $field .= '$form->time(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))->format(\'HH:mm:ss\')';
            } else if ($attribute['type'] == 'date') {
                $field .= '$form->date(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))->format(\'YYYY-MM-DD\')';
            } else if ($attribute['type'] == 'datetime') {
                $field .= '$form->datetime(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))->format(\'YYYY-MM-DD HH:mm:ss\')';
            } else if ($attribute['type'] == 'currency') {
                $field .= '$form->currency(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))->symbol(\'USD\')';
            } else if ($attribute['type'] == 'rate') {
                $field .= '$form->rate(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))';
            } else if ($attribute['type'] == 'image') {
                $field .= '$form->image(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))';
            } else if ($attribute['type'] == 'multipleImage') {
                $field .= '$form->multipleImage(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))';
            } else if ($attribute['type'] == 'file') {
                $field .= '$form->file(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))';
            } else if ($attribute['type'] == 'multipleFile') {
                $field .= '$form->multipleFile(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))';
            } else if ($attribute['type'] == 'slider') {
                $field .= '$form->slider(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))->options([\'max\' => 100, \'min\' => 1, \'step\' => 1, \'postfix\' => \'' . $attribute['label'] . '\'])';
            } else {
                $field .= '$form->text(\'' . $attribute['name'] . '\', __(\'' . $attribute['label'] . '\'))';
            }

            if (!in_array('nullable', $attribute['rules'])) {
                $field .= '->required()';
            }

            return $field . ';';
        });

        $stub = str_replace(
            [
                '{{tableColumns}}',
                '{{detailFields}}',
                '{{formFields}}',
            ],
            [
                $tableColumns->implode('' . PHP_EOL . "\t\t"),
                $detailFields->implode('' . PHP_EOL . "\t\t"),
                $formFields->implode('' . PHP_EOL . "\t\t"),
            ],
            $stub
        );

        file_put_contents(app_path("/Admin/Controllers/{$modelName}Controller.php"), $stub);
    }

    protected function createApiController($modelName)
    {
    }

    protected function createMigration($modelName, $attributes)
    {
        $stub = $this->getStubReplaced('Migration', $modelName);

        $formatedAttributes = $this->getFormattedAttributes($attributes);

        $tableColumns = $formatedAttributes->map(function ($attribute) {
            $migationField = '';
            if ($attribute['type'] == 'text') {
                $migationField .= '$table->text("' . $attribute['name'] . '")';
            } else if ($attribute['type'] == 'integer') {
                $migationField .= '$table->integer("' . $attribute['name'] . '")';
            } else if ($attribute['type'] == 'boolean') {
                $migationField .= '$table->boolean("' . $attribute['name'] . '")';
            } else if ($attribute['type'] == 'date') {
                $migationField .= '$table->date("' . $attribute['name'] . '")';
            } else if ($attribute['type'] == 'time') {
                $migationField .= '$table->time("' . $attribute['name'] . '", 0)';
            } else if ($attribute['type'] == 'datetime') {
                $migationField .= '$table->dateTime("' . $attribute['name'] . '", 0)';
            } else {
                $migationField .= '$table->string("' . $attribute['name'] . '")';
            }

            if (in_array('nullable', $attribute['rules'])) {
                $migationField .= '->nullable()';
            }

            return $migationField . ';';
        });

        $stub = str_replace(
            [
                '{{tableColumns}}',
            ],
            [
                $tableColumns->implode('' . PHP_EOL . "\t\t\t"),
            ],
            $stub
        );

        $migrationName = date('Y_m_d_His') . '_create_' . strtolower($this->strPlural($modelName)) . '_table';

        file_put_contents(base_path("/database/migrations/{$migrationName}.php"), $stub);
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function createApiResourceRoutes($modelName)
    {
        $apiRoutesLines = file(app_path('routes/api.php'));
        array_pop($apiRoutesLines);
        $apiRoutesContent = implode('', $apiRoutesLines);
        file_put_contents(base_path('routes/api.php'), $apiRoutesContent . "\n\n\t" . 'Route::resource(\'' . $this->strPlural(strtolower($modelName)) . "', '{$modelName}Controller');");
    }

    protected function createAdminResourceRoutes($modelName)
    {
        $adminRoutesLines = file(app_path('/Admin/routes.php'));
        array_pop($adminRoutesLines);
        $adminRoutesContent = implode('', $adminRoutesLines);
        file_put_contents(app_path('/Admin/routes.php'), $adminRoutesContent . "\n\t" . '$router->resource(\'' . $this->strPlural(strtolower($modelName)) . '\', ' . $modelName . 'Controller::class);' . PHP_EOL . '});' . PHP_EOL);
    }

    protected function strPlural($str)
    {
        return $str . 's';
    }

    protected function getStubReplaced($stubName, $modelName)
    {
        $stub = $this->getStub($stubName);
        $stub = $this->replacePlaceholdersWithModelName($stub, $modelName);

        return $stub;
    }

    protected function replacePlaceholdersWithModelName($stub, $modelName)
    {
        return str_replace(
            [
                '{{modelNamePluralLowerCase}}',
                '{{modelNamePlural}}',
                '{{modelNameLowerCase}}',
                '{{modelName}}',
            ],
            [
                strtolower($this->strPlural($modelName)),
                $this->strPlural($modelName),
                strtolower($modelName),
                $modelName,
            ],
            $stub
        );
    }

    protected function getFormattedAttributes($attributes)
    {
        return $attributes->map(function ($attribute) {
            $attributesParts = collect(explode(':', $attribute));
            $name = trim($attributesParts[0]);
            $type = isset($attributesParts[1]) && $attributesParts[1] ? trim($attributesParts[1]) : 'string';
            $label = isset($attributesParts[2]) ? trim($attributesParts[2]) : ucfirst($name);
            $rules = isset($attributesParts[3]) ? explode(',', $attributesParts[3]) : [];

            return [
                'name' => $name,
                'type' => $type,
                'label' => $label,
                'rules' => $rules,
            ];
        });
    }
}
