var vm = new Vue({  
    el: "#detail_tag",
    data: {
    },
});

var pathname = window.location.pathname;

$(document).ready(function () {
    callDonutChart();
});


$("#btn-delete").click(function(){
    if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
        const idnya = $(this).attr('dataid');
        $.ajax({
            url: pathname+"?r=mitrabps/delete&id=" + idnya,
            type:"post",
            dataType :"json",
            success : function(data)
            {
                if(data.satu.length>0){
                    alert(data.satu);
                }
                else{
                    window.location.href=pathname+ "?r=mitrabps/index"
                }
            }
        });
    }
});

function callDonutChart(){
    $(".donut-chart").each(function() {
        setDonutChart($(this).attr('id'));
    });
}

function setDonutChart(id_chart){
    chartEl = $("#"+id_chart);

    var donutData = [
        {label: chartEl.data('optone'), data: chartEl.data('one'), color: "#DD5245"},
        {label: chartEl.data('opttwo'), data: chartEl.data('two'), color: "#F5CD46"},
        {label: chartEl.data('optthree'), data: chartEl.data('three'), color: "#5BA05C"},
        {label: chartEl.data('optfour'), data: chartEl.data('four'), color: "#0E58E3"}
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