<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Revenda Herbie </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{route('site.index')}}">Revenda Herbie</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{route('site.index')}}">Home</a></li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Cadastros <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('carros.index')}}">Veículos</a></li>
                            <li><a href="{{route('marcas.index')}}">Marcas</a></li>
                            
                        </ul>
                    </li>

                    <li><a href="{{route('carros.pesq')}}">Pesquisas</a></li>

                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Graficos <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('carros.graf')}}">Veículos</a></li>
                            <li><a href="{{route('carros.grafprop')}}">Propostas</a></li>

                            
                        </ul>
                    </li>
                    <li><a href="{{route('vendas.rel')}}">Relatórios</a></li>
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span>{{Auth::user()->name}}</a></li>

                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
                            <span class="glyphicon glyphicon-log-out"></span>Sair
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </nav>



            @yield('conteudo')


    </body>
</html>
