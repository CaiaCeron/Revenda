@extends('loja.principal')

@section('conteudo')
    <script src="{{url('/js/jquery.mask.min.js')}}"></script>

    <div class="conainer">

        <div class="col-sm-6">

            <img src="../../fotos/{{$carro->id}}.jpg" class="img-rounded"  alt="{{$carro->modelo}}" width="380" height="250"/>
            <h3>Modelo: {{$carro->modelo}}</h3>
            <h3>Marca: {{$carro->marca->nome}}</h3>
            <h3>Valor do veiculo R$: {{number_format($carro->preco, 2, ',', '.')}}</h3>
            <h3>Cor: {{$carro->cor}}</h3>
            <h3>Ano: {{$carro->ano}}</h3>
            <h3>Combústivel: {{$carro->combustivel}}</h3>
        </div>

        <div class="col-sm-6" style="border-radius: 7px; border: 1px solid black;width: 600px ; padding: 25px">
            <h3>Formulário de Proposta</h3>
    <form method="post" action="{{route('site.prop', $carro->id)}}">
        {{ csrf_field() }}
        <div class="form-group" >
            <label for="Nome">Nome: </label>
            <input type="text" class="form-control" id="nome" placeholder="Digite seu nome" value="{{old('nome')}}" name="nome">
        </div>
        <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" class="form-control" id="email" placeholder="Digite seu e-mail" value="{{old('email')}}" name="email">
        </div>
        <div class="form-group">
            <label for="telefone">Telefone: </label>
            <input type="text" class="form-control" id="telefone" placeholder="Digite seu telefone" value="{{old('telefone')}}" name="telefone">
        </div>
        <div class="form-group">
            <label for="valor">Valor da Proposta: </label>
            <input type="text" class="form-control" id="valor" placeholder="Faça sua proposta" value="{{old('vslor')}}" name="valor">
        </div>



        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
    </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#telefone').mask('(00) 00000-0000');
            $('#valor').mask("##.###.##0,00", {reverse: true});
        });
    </script>
    @endsection

