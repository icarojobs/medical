<?php

namespace App\Http\Controllers\Site;

use App\Http\Resources\ScheduleResource;
use App\Models\Patient;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use UxWeb\SweetAlert\SweetAlert;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = Patient::where('document', $request->document)->first();


        if($patient){
            $schedule = Schedule::updateOrCreate([
                'scheduled_date' => $request->scheduled_date,
                'patient_id' => $patient->id,
                'doctor_id' => $request->doctor_id
            ]);
        }

        if(!$patient)
        {
            alert()->error('O seu documento não foi encontrado. Por favor, solicite o seu cadastro', 'Erro de Cadastro')->persistent();
            return redirect()->back()->withInput();
        }

        if($patient && $schedule)
        {
            alert()->success('Agenda cadastrada! Aguarde a confirmação.', 'Agendamento')->persistent();
            return redirect('/');
        }

        alert()->error('Erro ao realizar agendamento. Preencha os campos corretamente ou solicite o seu cadastro.', 'Agendamento')->persistent();
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($document)
    {
        $patient = Patient::where('document', $document)->firstOrFail();
        $schedule = Schedule::where('patient_id', $patient->id)->get();

        return new ScheduleResource($schedule);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
