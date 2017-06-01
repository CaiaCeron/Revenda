<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Revenda Herbie</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">

                <div class="navbar-header">

                    <a class="navbar-brand" href="{{route('site.index')}}">Revenda Herbie</a>
                </div>

                <ul class="nav navbar-nav">

                    <li class="active"><a href="/">Home</a></li>
                    <li><a href="#">Catalogo de Veiculos</a></li>
                    <li><a href="#">Fale Conosco</a></li>
                </ul>
                <form class="navbar-form navbar-left" method="post" action="{{route('site.pesq')}}">
                    {{csrf_field()}}
                    <div class="input-group">
                        <input type="text" class="form-control" name="modelo" placeholder="Pesquisar..." style="width: 400px">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </nav>

    @yield('conteudo')


    </body>
</html>

