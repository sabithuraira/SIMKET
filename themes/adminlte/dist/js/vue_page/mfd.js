var vm = new Vue({  
    el: "#mfd_tag",
    data: {
        hello: "Hello world",
        data: [],
    },
});

var loading = $("#loading");

firebase.initializeApp({
    apiKey: "AIzaSyAzSb1P0Rq3r74dvSVxZXViidt2nULUtX4",
    authDomain: "mfdfirestore.firebaseapp.com",
    databaseURL: "https://mfdfirestore.firebaseio.com",
    projectId: "mfdfirestore",
    storageBucket: "mfdfirestore.appspot.com",
    messagingSenderId: "830731479472"
});
  
// Initialize Cloud Firestore through Firebase
var db = firebase.firestore();

$(document).ready(function() {
    loading.css("display", "block");

    db.collection("datas").get().then((querySnapshot) => {
        querySnapshot.forEach((doc) => {
            var cur_data={
                idnya: doc.id,
                art_laki: doc.data().art_laki,
                art_perempuan: doc.data().art_perempuan,
                blok_sensus: doc.data().blok_sensus,
                bsbtt: doc.data().bsbtt,
                desa_nama: doc.data().desa_nama,
                desa_no: doc.data().desa_no,
                kab_nama: doc.data().kab_nam,
                kab_no: doc.data().kab_no,
                kec_nama: doc.data().kec_nama,
                kec_no: doc.data().kec_no,
                kk: doc.data().kk,
                muatan_dominan: doc.data().muatan_dominan,
                prov_nama: doc.data().prov_nama,
                prov_no: doc.data().prov_no,
                ruta_biasa: doc.data().ruta_biasa,
                ruta_khusus: doc.data().art_khusus
            };
            vm.data.push(cur_data);
        });
        loading.css("display", "none");
    }); 

    // for(var i=0;i<data_list.length;++i){
    //     // batch.add(coll, data_list[i]);
    //     db.collection("datas").add(data_list[i])
    //     .then(function(docRef) {
    //         console.log("Document written with ID: ", docRef.id);
    //     })
    //     .catch(function(error) {
    //         console.error("Error adding document: ", error);
    //     });
    // }
});