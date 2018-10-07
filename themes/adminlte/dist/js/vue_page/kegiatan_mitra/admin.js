var pathname = window.location.pathname;

$(".btn-delete").click(function(){
    if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
        const idnya = $(this).attr('dataid');
        $.ajax({
            url: pathname+"?r=kegiatan_mitra/delete&id=" + idnya,
            type:"post",
            dataType :"json",
            success : function(data)
            {
                if(data.satu.length>0)
                    alert(data.satu);
                window.location.href=pathname+ "?r=kegiatan_mitra/index"
            }
        });
    }
});