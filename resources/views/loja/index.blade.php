@extends('loja.principal')

@section('conteudo')

@if(isset($cont))
<div class="row">
    @if($cont > 0)
    <div class="col-sm-12" style="margin-left: 10px">
        <h2>Carros em destaque</h2>
        <hr>
    </div>
    @endif
    @endif

    @if(isset($destaque))
    @foreach($destaque as $d)
    @if($d->destaque == 'v')

    <div class="col-sm-4" style="text-align: center; padding-bottom: 50px">
        <div style="border-radius: 7px; border: 1px solid gray; margin: 0px 106px 20px 20px">
            <img src="../fotos/{{$d->id}}.jpg" class="img-rounded"  alt="{{$d->modelo}}" width="301" height="211"/>
            <h3>{{$d->marca->nome}} - {{$d->modelo}}</h3>
            <h3>R$: {{number_format($d->preco, 2, ',', '.')}}</h3>

            <p><a href="{{route('site.proposta', $d->id)}}"
                  class='btn btn-success'
                  role='button'> Fazer Proposta</a></p>
        </div>

    </div>
    @endif
    @endforeach
</div>
&nbsp;&nbsp;&nbsp;
@endif


<div class="row">
    @if(isset($lista))
    <div class="col-sm-12" style="margin-left: 10px">
        <h2>Lista de Veiculos</h2>
        <hr>
    </div>
    @endif

    @forelse($lista as $l)

    <div class="col-sm-4" style="text-align: center; padding-bottom: 50px">
        <div style="border-radius: 7px; border: 1px solid gray; margin: 0px 106px 20px 20px">
            <img src="../fotos/{{$l->id}}.jpg" class="img-rounded"  alt="{{$l->modelo}}" width="301" height="211"/>
            <h3>{{$l->marca->nome}} - {{$l->modelo}}</h3>
            <h3>R$: {{number_format($l->preco, 2, ',', '.')}}</h3>

            <p><a href="{{route('site.proposta', $l->id)}}"
                  class='btn btn-success'
                  role='button'> Fazer Proposta</a></p>
        </div>

    </div>
    @empty
    <div class="col-sm-12">
        <h3 style="margin-left: 15px ;">Não há veiculos... </h3>
    </div>

    @endforelse


<div class="col-sm-12" style="text-align: center;">
    @if(isset($destaque))
    {{ $lista->links() }}
    @endif
</div>
    
@endsection