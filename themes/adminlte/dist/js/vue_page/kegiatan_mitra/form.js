var vm = new Vue({  
    el: "#form_tag",
    data: {
    },
    methods: {    
    },
});


function showAndHideLoading(){
    if($('.loading').css("display")=='none'){
        $(".loading").css("display","block");
        $(".loading_message").html("Loading...");
    }
    else{
        $(".loading").css("display","none");
    }
}