<!DOCTYPE html>
<html>

<head>
    <title>Laravel Google Chart Implementation Example</title>
</head>

<body class="antialiased">
    <h2>Integrating Line Chart in Laravel</h2>
    <div id="linechart" style="width: 1000px; height: 500px"></div>

    <form action="/print_chart" method="post" enctype="multipart/form-data">
     @csrf
     <input type="hidden" name="chartData" id="chartInputData">
     <input type="submit" value="Print Data">

    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var population = <?php echo $population; ?>;
        console.log(population);
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(lineChart);

        function lineChart() {
            var data = google.visualization.arrayToDataTable(population);
            var options = {
                title: 'Wildlife Population',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('linechart'));

            chart.draw(data, options);


                // $('#linechart').append("<div id='linechart"+chart+"'></div>")


               let chart_div = document.getElementById("linechart")


            // let ch = new google.visualization.LineChart(chart_div )
            // console.log(ch )

                chart_div.innerHTML = '<img src="'+chart.getImageURI()+'">'



            // console.log("DATA",data);

            setTimeout(function(){
                let chartData = $("#linechart").html();
                $("#chartInputData").val(chartData);
            },1000)
        }

    </script>
    <a href="/line">Teste</a>
</body>

</html>
