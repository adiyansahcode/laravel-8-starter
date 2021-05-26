<x-html :title="isset($title) ? $title . ' | ' . config('app.name') : ''">

  <x-slot name="head">
    <!-- favicon -->
    <!-- https://realfavicongenerator.net/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}" />
    <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#ef3b2d" />
    <meta name="msapplication-TileColor" content="#ef3b2d" />
    <meta name="theme-color" content="#ffffff" />

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />

    @bukStyles
    @stack('styles')
  </x-slot>

  {{ $slot }}

  @bukScripts
  @stack('scripts')

  @if(config('firebase.fcm') === true)
    <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-messaging.js"></script>
    <script>
      var firebaseConfig = {
        apiKey: "AIzaSyDcwoqYTOccjWfSXQJ9i92sY5xFZlomY98",
        authDomain: "laravel-firebase-notific-99ac6.firebaseapp.com",
        databaseURL: "https://laravel-firebase-notific-99ac6-default-rtdb.asia-southeast1.firebasedatabase.app",
        projectId: "laravel-firebase-notific-99ac6",
        storageBucket: "laravel-firebase-notific-99ac6.appspot.com",
        messagingSenderId: "615116595377",
        appId: "1:615116595377:web:830069a9f103cdc9970290",
        measurementId: "G-89XK1FNDYM"
      };
      firebase.initializeApp(firebaseConfig);
      firebase.analytics();
      const messaging = firebase.messaging();

      if (!("Notification" in window)) {
        console.log('This browser does not support desktop notification');
      }
      else if (Notification.permission === "granted") {
        generateToken();
        sendNotification();
      }
      else if (Notification.permission !== "denied") {
        Notification.requestPermission().then(function (permission) {
          if (permission === "granted") {
            generateToken();
            sendNotification();
          }
        });
      }

      function sendNotification() {
        messaging.onMessage(function (payload) {
          console.log('Message received. ', payload);
          const title = payload.notification.title;
          const options = {
              body: payload.notification.body,
              icon: payload.notification.image,
          };
          new Notification(title, options);
        });
      }

      function generateToken() {
        if (document.getElementById('form-login') !== null) {
          messaging.getToken().then((token) => {
            if (token) {
              var form = document.getElementById('form-login');
              form.innerHTML += '<input type="hidden" name="fcmToken" id="fcmToken" value="' + token + '" >';
            } else {
              console.log('No registration token available. Request permission to generate one.');
            }
          }).catch((err) => {
            console.log('An error occurred while retrieving token. ', err);
          });
        }
      }
    </script>
  @endif
</x-html>
