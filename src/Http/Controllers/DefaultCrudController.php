<?php

namespace BrandStudio\Starter\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Str;

class DefaultCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected $class;
    protected $requestClass;

    public function setup()
    {
        $this->crud->setModel($this->class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/'.strtolower(class_basename($this->class)));
        $this->crud->setEntityNameStrings(trans_choice('admin.'.(new $this->class)->getTable(), 1), trans_choice('admin.'.(new $this->class)->getTable(), 2));
    }

    protected function setupFilters()
    {

    }

    protected function setupListOperation()
    {
        $this->setupFilters();

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation($this->requestClass);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        CRUD::set('show.setFromDb', false);
        $this->setupListOperation();
    }

    protected function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'name');
        CRUD::set('reorder.max_level', 1);
    }


}
