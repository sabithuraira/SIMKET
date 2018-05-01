var vm = new Vue({  
    el: "#detail_tag",
    data: {
    },
});

var pathname = window.location.pathname;

$(document).ready(function () {
    callDonutChart();
});

function callDonutChart(){
    $(".donut-chart").each(function() {
        setDonutChart($(this).attr('id'));
    });
}

function setDonutChart(id_chart){
    chartEl = $("#"+id_chart);

    var donutData = [
        {label: chartEl.data('optone'), data: chartEl.data('one'), color: "#B2D1E4"},
        {label: chartEl.data('opttwo'), data: chartEl.data('two'), color: "#3c8dbc"},
        {label: chartEl.data('optthree'), data: chartEl.data('three'), color: "#0073b7"},
        {label: chartEl.data('optfour'), data: chartEl.data('four'), color: "#00c0ef"}
    ];

      $.plot("#"+id_chart, donutData, {
        series: {
          pie: {
            show: true,
            radius: 1,
            innerRadius: 0.5,
            label: {
              show: true,
              radius: 2 / 3,
              formatter: labelFormatter,
              threshold: 0.1
            }
  
          }
        },
        legend: {
          show: false
        }
      });
}

function labelFormatter(label, series) {
    return '<div style="font-size:11px; text-align:center; padding:1px; color: #000; font-weight: 400;">'
        + label +"</div>";
}