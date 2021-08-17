// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
var firebaseConfig = {
    apiKey: "AIzaSyDblE9KN31I_iUCm5qaogoXBgEVZ-LO0aE",
    authDomain: "la-sirene.firebaseapp.com",
    projectId: "la-sirene",
    storageBucket: "la-sirene.appspot.com",
    messagingSenderId: "73416519788",
    appId: "1:73416519788:web:efee97e6ff6442299be849"
  };


// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);

    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };

    return self.registration.showNotification(
        title,
        options,
    );
});