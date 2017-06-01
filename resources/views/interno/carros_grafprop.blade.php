@extends('interno.principal')

@section('conteudo')

<div class="col-sm-12">
    <h3> Gráficos de Propostas</h3>



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Modelo', 'N° Propostas'],
            @foreach($graf as $g)
            {!! "['$g->modelo', $g->num],"!!}
                
                
            @endforeach
            
            ]);

            var options = {
                title: 'Total de propostas por veiculo',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>


    <div id="piechart_3d" style="width: 1200px; height: 800px;"></div>

</div>



@endsection