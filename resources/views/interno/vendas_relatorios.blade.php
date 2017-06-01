@extends('interno.principal')

@section('conteudo')
    <div class='col-sm-12'>
        <h2>Relatório de Propostas</h2>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Cliente</th>
                <th>Carro</th>
                <th>Proposta</th>
                <th>Email</th>
                <th>Contato</th>
            </tr>
            </thead>
    <tbody>
    @foreach ($relatorio as $rel)
        <tr>
            <td> {{$rel->nome}} </td>
            <td> {{$rel->modelo}} </td>
            <td>R$: {{number_format($rel->valor, 2, ',', '.')}} &nbsp;&nbsp; </td>
            <td> {{$rel->email}} </td>
            <td> {{$rel->fone}} </td>




        </tr>
    @endforeach
    </tbody>
        </table>
    </div>


    @endsection