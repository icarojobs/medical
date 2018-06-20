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
    </head>
    <body>

    <header>
        <div class="navbar navbar-dark bg-dark box-shadow">
            <div class="container d-flex justify-content-between">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <i class="fa fa-medkit"></i> &nbsp;<strong> {{ config('app.name') }}</strong>
                </a>

            </div>
        </div>
    </header>

    <main role="main" id="app">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">O que deseja fazer?</h1>
                <p class="lead text-muted">Através do sistema MediCal é possivel realizar e consultar agendamentos.</p>

                <p>
                    <button class="btn btn-primary my-2">Ver meus agendamentos</button>
                    <button class="btn btn-secondary my-2">Agendar horário com Dr.</button>
                </p>

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
                                    <form class="form-inline" id="form_list_schedule">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control" placeholder="RG ou CPF">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Ver agenda</button>
                                    </form>
                                </div>

                                <div class="col-md-12 my-2">
                                    <h4>Meus Agendamentos</h4>
                                </div>

                                <div class="col-md-12">
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


                                        <tr>
                                            <th scope="row">08/02/2018</th>
                                            <td>05:00</td>
                                            <td>Dr. Pasquali</td>
                                            <td>Não<td>
                                        </tr>


                                        </tbody>
                                    </table>
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
                                    <form class="form-inline" action="{{ url('api/schedules') }}" method="post">

                                        <div class="form-group mb-2 mr-2">
                                            <input name="scheduled_date" type="datetime-local" class="form-control" placeholder="Informa Data e Horário">
                                        </div>

                                        <div class="form-group mb-2 mr-2">
                                            <input name="document" type="search" class="form-control" placeholder="Seu RG ou CPF">
                                        </div>
                                        <div class="form-group mb-2 mr-2">
                                            <input name="doctor" type="text" class="form-control" placeholder="Doutor (select2)">
                                        </div>

                                        <button type="submit" class="btn btn-primary mb-2">Agendar</button>
                                    </form>
                                </div>

                                <div class="col-md-12 my-2">
                                    <h4>Resposta</h4>
                                    <div id="result_add_schedule"></div>
                                </div>



                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </main>

    <footer class="text-muted badge-dark">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>
            <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
            <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a href="../../getting-started/">getting started guide</a>.</p>
        </div>
    </footer>




        <script src="{{ mix('js/app.js') }}"></script>

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
