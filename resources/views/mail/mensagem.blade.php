@extends('interno.principal')

@section('conteudo')

    <form method="post" action="{{route('vendas.envmensagem')}}">
        {{ csrf_field() }}
        <div class="col-sm-12">
            <h2>Contato com Cliente</h2>

            <div class="form-group">
                <label for="assunto">Assunto:</label>
                <input type="text" class="form-control" id="assunto" name="assunto">
                <label for="mens">Mensagem:</label>
                <textarea class="form-control" rows="5" id="mens" name="mensagem"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>


@endsection