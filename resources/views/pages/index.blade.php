<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

        <style>
            .select2-container .select2-selection--single {
                box-sizing: border-box;
                cursor: pointer;
                display: block;
                height: 36px;
                user-select: none;
                -webkit-user-select: none;

            }
        </style>

    </head>
    <body>

    <header>
        <div class="navbar navbar-dark bg-dark box-shadow">
            <div class="container d-flex justify-content-between">
                <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
                    <i class="fa fa-medkit"></i> &nbsp;<strong> {{ config('app.name') }}</strong>
                </a>

            </div>
        </div>
    </header>

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
                                            <input name="document" type="search" class="form-control" placeholder="RG ou CPF" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Ver agenda</button>
                                    </form>
                                </div>

                                <div class="col-md-12 my-2">
                                    <h4>Meus Agendamentos</h4>
                                </div>

                                <div class="col-md-12 table-responsive">

                                    @if($schedules)

                                        @if($schedules->isEmpty())
                                            <p class="text-info">Documento encontrado, mas não existe nenhum agendamento para você.</p>
                                        @else
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Data Agendamthto</th>
                                                    <th scope="col">Horário</th>
                                                    <th scope="col">Doutor</th>
                                                    <th scope="col">Confirmado?</th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @foreach($schedules as $schedule)
                                                    <tr>
                                                        <th scope="row">{{ date('d/m/Y', strtotime($schedule->scheduled_date)) }}</th>
                                                        <td>{{ date('H:i', strtotime($schedule->scheduled_date)) }}</td>
                                                        <td>{{ $schedule->doctor->name }}</td>
                                                        <td>{{ $schedule->is_confirmed == 0 ? 'Não' : 'Sim' }}<td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        @endif
                                    @else
                                        <p>Informe o seu RG ou CPF para visualizar os seus agendamentos.</p>
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
                                                <input name="document" type="search" class="form-control" placeholder="Seu RG ou CPF" required>
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

    <footer class="text-muted badge-dark py-4">
        <div class="container">
            <p>MediCal &copy; has developed by <a href="https://github.com/icarojobs" target="_blank">Icaro Jobs</a></p>
            <p>Repository: <a href="https://github.com/icarojobs/medical" target="_blank">Github</a>  | <a href="{{ url('admin') }}">Área Administrativa</a> </p>
        </div>
    </footer>


    <script src="{{ mix('js/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    @include('sweet::alert')

    {{-- Select2 Plugin --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    {{-- Axios --}}
    <script>
        axios.get('/api/schedules/33586736851')
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
    </script>
    </body>
</html>
