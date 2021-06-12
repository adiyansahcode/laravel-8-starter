// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/8.6.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.6.2/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
  apiKey: 'AIzaSyDcwoqYTOccjWfSXQJ9i92sY5xFZlomY98',
  authDomain: 'laravel-firebase-notific-99ac6.firebaseapp.com',
  databaseURL: 'https://laravel-firebase-notific-99ac6-default-rtdb.asia-southeast1.firebasedatabase.app',
  projectId: 'laravel-firebase-notific-99ac6',
  storageBucket: 'laravel-firebase-notific-99ac6.appspot.com',
  messagingSenderId: '615116595377',
  appId: '1:615116595377:web:830069a9f103cdc9970290',
  measurementId: 'G-89XK1FNDYM'
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
