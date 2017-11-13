var vm = new Vue({  
    el: "#mfd_tag",
    data: {
        hello: "Hello world",
        data: [],
    },
});



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

});