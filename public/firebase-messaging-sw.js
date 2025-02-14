importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-messaging.js');
   
	firebase.initializeApp({
    apiKey: "AIzaSyCfuca-npDZDQ0CaDdJTymzRinJhv7OHI8",
    authDomain: "adlineschool-5f557.firebaseapp.com",
    projectId: "adlineschool-5f557",
    storageBucket: "adlineschool-5f557.appspot.com",
    messagingSenderId: "656790156591",
    appId: "1:656790156591:web:8f78660818cb09728f5dda",
    measurementId: "G-14K4V2Y4DH"
    });

	const messaging = firebase.messaging();
	messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
        
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };
  
    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});