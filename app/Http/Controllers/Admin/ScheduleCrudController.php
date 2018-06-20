<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ScheduleRequest as StoreRequest;
use App\Http\Requests\ScheduleRequest as UpdateRequest;

class ScheduleCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Schedule');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/schedule');
        $this->crud->setEntityNameStrings('agendamento', 'agendamentos');

        /*
        |--------------------------------------------------------------------------
        | COLUMNS TO LIST
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumn([
            'label' => 'Data Agendamento',
            'name' => 'scheduled_date',
            'type' => 'datetime'
        ]);

        $this->crud->addColumn([
            'label' => 'Paciente',
            'name' => 'patient_id', // name of THIS model column
            'type' => 'select',
            'entity' => 'patient', // name of relationship
            'attribute' => 'name', // name of Model column related
            'model' => 'App\Models\Patient',
        ]);

        $this->crud->addColumn([
            'label' => 'Doutor',
            'name' => 'doctor_id', // name of THIS model column
            'type' => 'select',
            'entity' => 'doctor', // name of relationship
            'attribute' => 'name', // name of Model column related
            'model' => 'App\Models\Doctor',
        ]);

        $this->crud->addColumn([
            'label' => 'Confirmado?',
            'name' => 'is_confirmed',
            'type' => 'select_from_array',
            'options' => [
                0 => 'Não',
                1 => 'Sim'
            ]
        ]);

        /*
        |--------------------------------------------------------------------------
        | FIELDS TO CRUD
        |--------------------------------------------------------------------------
        */
        $this->crud->addField([
            'label' => 'Data Agendamento',
            'name' => 'scheduled_date',
            'type' => 'datetime'
        ]);

        $this->crud->addField([
            'label' => 'Paciente',
            'name' => 'patient_id', // name of THIS model column
            'type' => 'select2',
            'entity' => 'patient', // name of relationship
            'attribute' => 'name', // name of Model column related
            'model' => 'App\Models\Patient',
        ]);

        $this->crud->addField([
            'label' => 'Doutor',
            'name' => 'doctor_id', // name of THIS model column
            'type' => 'select2',
            'entity' => 'doctor', // name of relationship
            'attribute' => 'name', // name of Model column related
            'model' => 'App\Models\Doctor',
        ]);

        $this->crud->addField([
            'label' => 'Confirmado?',
            'name' => 'is_confirmed',
            'type' => 'checkbox'
        ]);
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
