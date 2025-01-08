<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeHexagonalModel extends Command
{
    protected $signature = 'make:hexmodel {name}';
    protected $description = 'Create a model in the Infrastructure/Models directory';

    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Infrastructure/Models/{$name}.php");

        if (file_exists($path)) {
            $this->error("Model already exists!");
            return;
        }

        $stub = file_get_contents(base_path('stubs/model.stub'));
        $stub = str_replace('DummyNamespace', 'App\Infrastructure\Models', $stub);
        $stub = str_replace('DummyClass', $name, $stub);

        file_put_contents($path, $stub);
        $this->info("Model created successfully at {$path}");
    }
}
