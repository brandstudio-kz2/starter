<?php

namespace BrandStudio\Starter\Console\Commands;

use Backpack\Generators\Console\Commands\CrudControllerBackpackCommand;

class CreateController extends CrudControllerBackpackCommand
{

    protected function getStub()
    {
        return config('starter.stubs_dir').'crud-controller.stub';
    }

}
