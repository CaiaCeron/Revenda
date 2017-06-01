@extends('interno.principal')

@section('conteudo')



<div class="col-sm-12">
    <h3> Gráficos de Carros</h3>



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Marca', 'N° Veiculos'],
            @foreach($carros as $carro)
            {!! "['$carro->marca', $carro->num],"!!}
                
                
            @endforeach
            
            ]);

            var options = {
                title: 'Total de veiculos por marca',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>


    <div id="piechart_3d" style="width: 1200px; height: 800px;"></div>

</div>



@endsection