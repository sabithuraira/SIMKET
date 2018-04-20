
var vm = new Vue({  
    el: "#mitra_tag",
    data: {
        nks:"",
        bs:"",
        wils: []
    },
    methods: {
        addWil: function () {
            if(this.nks == "" || this.bs == ""){
                alert("Lengkapi data NKS dan Blok Sensus");
            }
            else{
                this.wils.push({
                    nks: this.nks,
                    bs: this.bs
                });

                this.nks = "";
                this.bs = "";
            }
        },
        removeWil: function (wil) {
          this.wils.splice(this.wils.indexOf(wil), 1)
        }
      },
});

var mitra_id    =$('#mitra_id');
var mitra_from  =$('#mitra_from');
var idkab  =$('#idkab');
var pathname = window.location.pathname;

$(document).ready(function () {
    
});

mitra_from.change(function(){
    $.ajax({
        url: pathname+"?r=kegiatan_mitra/get_list_mitra&id=" + idkab.val(),
        type:"post",
        dataType :"json",
        data:{
            "mitra_from": mitra_from.val(),
        },
        success : function(data)
        {
            mitra_id.html(data.satu);
        }
    });
});

$('#InfroTextSubmit').click(function(){
    var idnya       =$('#idnya').val();
    var mitra_status=$('#mitra_status').val();

    // console.log(JSON.stringify(mitra_nks));

    $.ajax({
        url: pathname+"?r=kegiatan_mitra/insert_petugas&id=" + idnya,
        type:"post",
        dataType :"json",
        data:{
            "mitra_id":mitra_id.val(),
            "mitra_from": mitra_from.val(),
            "mitra_status":mitra_status,
            "mitra_wils": vm.wils
        },
        success : function(data)
        {
            if(data.satu.length >0)
            {
                window.location.href=pathname+ "?r=kegiatan_mitra/mitra&id="+data.satu
            }
            else
            {
                alert('Data gagal disimpan, refresh halaman anda dan ulangi lagi');
            }
        }
    });
});