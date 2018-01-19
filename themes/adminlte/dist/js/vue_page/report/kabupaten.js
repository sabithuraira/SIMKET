
var vm = new Vue({  
    el: "#kabupaten_tag",
    data: {},
});

var areaChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: false,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };
var pathname = window.location.pathname;

$(document).ready(function() {
    loadChart();
});

function loadChart(){
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    
    // loading.css("display", "block");
    $.ajax({
        url: pathname+"?r=report/api_report_kabupaten",
        dataType: 'json',
        type: "GET",
        success: function(data) {
            setDataReportSeries(data);

            // loading.css("display", "none");
        }.bind(this),
        error: function(xhr, status, err) {
            alert("Terjadi kesalahan pada internet, harap refresh halaman");
        }.bind(this)
    });


    var areaChart = new Chart(areaChartCanvas);

    var areaChartData = null;

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions);
}

function setDataReportSeries(){

    // var d1=[];
    // <?php 
    //     $tahun=date('Y');
    //     foreach ($dataprogress as $key => $value) { ?>
    //     d1[d1.length]=[gd(<?php echo $tahun; ?>,<?php echo $value['bulan']-1 ?>,1),<?php echo $value['nilai'] ?>];
    // <?php } ?>

    var labels = ["January", "February", "March", "April", "May", "June", "July", "Agustus", "September", "Oktober", "November", "Desember"];
    var datas = array();



    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
      {
        label: "Electronics",
        fillColor: "rgba(210, 214, 222, 1)",
        strokeColor: "rgba(210, 214, 222, 1)",
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [65, 59, 80, 81, 56, 55, 40]
      }
    ]
}

function gd(year, month, day) {
    return new Date(year, month, day).getTime();
}