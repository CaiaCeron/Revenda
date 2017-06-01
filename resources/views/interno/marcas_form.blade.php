@extends('interno.principal')

@section('conteudo')


<div class="col-sm-11">
    @if($acao == 1)
    <h2>Cadastro de Marcas</h2>
    @elseif($acao == 2)
    <h2>Alteração de Marcas</h2>
    @endif
</div>
<div class="col-sm-12">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<div class="col-sm-1">
    <a href="{{route('marcas.index')}}" class="btn btn-primary" role="button"> Voltar </a>
</div>
<div class="col-sm-12">
    @if($acao == 1)
    <form method="POST" action="{{route('marcas.store')}}">
        @elseif($acao == 2)
        <form method="POST" action="{{route('marcas.update', $marca->id)}}">
            {!! method_field('PUT') !!}
            @endif
            {{ csrf_field() }}
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{$marca->nome or old('nome')}}" required>
            </div>
            <button type="submit" class="btn btn-default">Enviar</button>
        </form>
</div>


@endsection