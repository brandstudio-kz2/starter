<?php

namespace BrandStudio\Starter\Console\Commands;

use Backpack\Generators\Console\Commands\CrudModelBackpackCommand;

class CreateModel extends CrudModelBackpackCommand
{

    protected function getStub()
    {
        return config('starter.stubs_dir').'crud-model.stub';
    }

    public function handle()
    {
        $name = $this->qualifyClass($this->getNameInput());

        $path = $this->getPath($name);

        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. We just make sure it uses CrudTrait
        // We add that one line. Otherwise, we will continue generating this class' files.
        if ((! $this->hasOption('force') ||
             ! $this->option('force')) &&
             $this->alreadyExists($this->getNameInput())) {
            $file = $this->files->get($path);
            $file_array = explode(PHP_EOL, $file);
            $this->info('Model already exists and uses CrudTrait.');
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);

        $this->files->put($path, $this->sortImports($this->buildClass($name)));

        $this->info($this->type.' created successfully.');
    }

}
