@extends('interno.principal')

@section('conteudo')



<div class="col-sm-11">
    <h2>Cadastro de Marcas</h2>
</div>
<div class="col-sm-1">
    <a href="{{route('marcas.create')}}" class="btn btn-primary" role="button"> Novo </a>
</div>
@if(session('status'))
<div class="col-sm-12">
    <div class="alert-success">
        {{session('status')}}
    </div>
</div>
@endif


<div class="col-sm-12">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Cód</th>
                <th>Nome</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($marcas as $marca)
            <tr>
                <td>{{$marca->id}}</td>
                <td>{{$marca->nome}}</td>
                
                <td>          
                    <a href="{{route('marcas.edit', $marca->id)}}" class="btn btn-warning" role="button"> Alterar </a>          
                    <form style="display:inline-block" method="post" action="{{route('marcas.destroy', $marca->id)}}" onsubmit="return confirm('Deseja Realmente excluir?')">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form> 
                </td>

            </tr>



            @endforeach
        </tbody>
    </table>
</div>

@endsection