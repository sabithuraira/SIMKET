var vm = new Vue({  
    el: "#calendar_tag",
    data: {
        hello: "Hello world",
        list_name: [
            {id: "198908232012111001", name: "Sabit Huraira" }, 
            {id: "196507311989011001", name: "PM Hamonangan"}
        ],
        data : [
            {id: 1, nip: "198908232012111001",  name: "Sabit Huraira", start_date: 20, end_date: 22, judul: "Task Force SE UMB UMK"},
            {id: 1, nip: "198908232012111001",  name: "Sabit Huraira", start_date: 10, end_date: 11, judul: "Ground Check Pemetaan Lahan Sawah"},
            {id: 2, nip: "196507311989011001", name: "PM Hamonangan", start_date: 11, end_date: 13, judul: "Supervisi SUSENAS 2017 Semester 2"},
        ],
        total_day: 30
    },
});

var thead = $("#tablehead");
var tbody = $("#tablebody");

$(document).ready(function() {
    generateHeader();
    generateBody();
    setJadwal();
});

function setJadwal(){
    for(var i=0;i<vm.data.length;++i){
        setCellJadwal(vm.data[i]);
    }
}

function setCellJadwal(data){
    if(data.start_date==data.end_date){
        $("#id"+data.nip+" td").eq(data.start_date+1).addClass("red");
    }
    else{
        var total_jadwal = data.end_date - data.start_date + 1;

        var start_cell= $("#id"+data.nip+" td").eq(data.start_date+1);

        start_cell.attr('colspan',total_jadwal);
        start_cell.addClass("red");
        console.log("masuk:"+data.judul);
        start_cell.append(data.judul);
        
        for(var d=data.start_date+1;d<=data.end_date;++d){
             $("#id"+data.nip+" td").eq(d+1).remove();
        }
    }
}

function generateHeader(){
    var str_head ='<th style="width: 20px">#</th><th></th>';

    for(var i=1;i<=vm.total_day;++i){
        str_head += '<th style="width: 30px">'+i+'</th>';
    }

    thead.append(str_head);
}

function generateBody(){
    var tbody = $("#tablebody");
    for(var i=0 ;i < 2; ++i){
        var str_body = '<tr id="id'+vm.list_name[i].id+'"><td>'+(i+1)+'.</td>';
        str_body += '<td class="gray">'+vm.list_name[i].name+'</td>';
        str_body += generateEmptyTd();
        str_body += '</tr>';

        tbody.append(str_body);
    }
}

function generateEmptyTd(){
    str_result="";
    for(var i=1;i<=vm.total_day;++i){
        str_result += '<td></td>';
    }

    return str_result;
}