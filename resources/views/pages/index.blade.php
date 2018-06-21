@extends('layouts.app')
@section('content')
    @include('includes.header')

    <main role="main" id="app">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">O que deseja fazer?</h1>
                <p class="lead text-muted">Através do sistema da MediCal é possivel visualizar e solicitar agendamentos médico</p>

                <small>Caso não consiga realizar um novo agendamento, solicite o seu cadastro com um de nossos atendentes.</small>
            </div>
        </section>

        <div class="bg-light">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 mx-auto" id="show_schedule">
                        <div class="card mb-4 box-shadow">
                            <div class="card-body">

                                <div class="col-md-8">
                                    <h2>Informe o seu documento</h2>
                                </div>

                                <div class="col-md-12">
                                    <form class="form-group" action="{{ url('get-schedules') }}" method="post">
                                        @csrf
                                        <div class="form-group mb-2 mr-2">
                                            <input name="document" type="search" class="form-control document" placeholder="Informe seu CPF" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Ver agenda</button>
                                    </form>
                                </div>

                                <div class="col-md-12 my-2">
                                    <h4>Meus Agendamentos</h4>
                                </div>

                                <div class="col-md-12">

                                    @if($schedules)

                                        @if($schedules->isEmpty())
                                            <p class="text-info">Documento encontrado, mas não existe nenhum agendamento para você.</p>
                                        @else

                                            <table id="show_schedules" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>Data Agendamento</th>
                                                    <th>Horário</th>
                                                    <th>Doutor</th>
                                                    <th>Confirmado?</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($schedules as $schedule)
                                                    <tr>
                                                        <td>{{ date('d/m/Y', strtotime($schedule->scheduled_date)) }}</td>
                                                        <td>{{ date('H:i', strtotime($schedule->scheduled_date)) }}</td>
                                                        <td>{{ $schedule->doctor->name }}</td>
                                                        <td>{{ $schedule->is_confirmed == 0 ? 'Não' : 'Sim' }}</td>
                                                    </tr>
                                                @endforeach

                                                </tbody>

                                                <tfoot>
                                                <tr>
                                                    <th>Data Agendamento</th>
                                                    <th>Horário</th>
                                                    <th>Doutor</th>
                                                    <th>Confirmado?</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                    @else
                                        <p>Informe seu CPF para visualizar os seus agendamentos.</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 mx-auto" id="new_schedule">
                        <div class="card mb-4 box-shadow">
                            <div class="card-body">

                                <div class="col-md-8">
                                    <h2>Novo Agendamento</h2>
                                </div>

                                <div class="col-md-12">
                                    <form class="form-group" action="{{ url('save-schedule') }}" method="post">
                                        @csrf

                                        <div class="row">

                                            <div class=" form-group mb-2 mr-2">
                                                <input name="scheduled_date" type="datetime-local" class="form-control" placeholder="Informa Data e Horário" required>
                                            </div>

                                            <div class="form-group mb-2 mr-2">
                                                <input name="document" type="search" class="form-control document" placeholder="Informe seu CPF" required>
                                            </div>
                                            <div class="form-group mb-2 mr-2">
                                                <select name="doctor_id" id="doctor" class="custom-select my-1 mr-sm-2 select2" required>
                                                    <option value="">Escolha...</option>
                                                    @foreach($doctors as $doctor)
                                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary" style="height: 34px;">Agendar</button>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </main>
@endsection