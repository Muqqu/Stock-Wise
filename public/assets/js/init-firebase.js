// import { initializeApp } from "https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js";
// import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.23.0/firebase-analytics.js";
// Your web app's Firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyA6eg5_ZSvG0Nzkpt_h4hAxzZWRlhahzG4",
    authDomain: "thugistockwise.firebaseapp.com",
    projectId: "thugistockwise",
    storageBucket: "thugistockwise.appspot.com",
    messagingSenderId: "203337695848",
    appId: "1:203337695848:web:f11f9286aa11da4d9a71dd",
    measurementId: "G-V2WQPKY576"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

messaging
    .requestPermission()
    .then(function() {
        console.log("Notification permission granted.");
        return messaging.getToken();
    })
    .then(function(token) {
        console.log(token);
    })
    .catch(function(err) {
        console.log("Unable to get permission to notify.", err);
    });

messaging.onMessage(function(payload) {
    console.log(payload);
    var notify;
    notify = new Notification(payload.notification.title, {
        body: payload.notification.body,
        icon: payload.notification.icon,
        tag: "Dummy"
    });
    console.log(payload.notification);
});