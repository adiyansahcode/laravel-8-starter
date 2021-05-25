<x-layouts.app :title="__('Profile')">
  <div class="py-5">
    <div class="max-w-7xl sm:max-w-md mx-auto sm:px-6 md:px-6 lg:px-8 xl:px-8">
      <div class="shadow-md overflow-hidden sm:rounded-md bg-white">

        @if (Session::has('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
          {{ session("status") }}
        </div>
        @endif

        <div class="text-center p-6 border-b">
          <img class="h-36 w-36 rounded-full mx-auto" alt="profile" src="{{ Auth::user()->getImage() }}" />
          <p class="pt-2 text-lg font-semibold">{{ Auth::user()->fullname }}</p>
          <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
          <p class="text-sm text-gray-600">{{ Auth::user()->phone }}</p>
        </div>

        <div class="border-b">
          <a href="{{ route('setting.profile') }}" class="px-4 py-2 hover:bg-gray-100 flex">
            <div class="text-gray-500 flex flex-wrap content-center">
              <x-heroicon-o-user-circle class="w-6 h-6" />
            </div>
            <div class="pl-3">
              <p class="text-sm font-medium text-gray-800 leading-none">
                Account
              </p>
              <p class="text-xs text-gray-500">Profile, Email, Phone</p>
            </div>
          </a>
          <a href="{{ route('setting.security') }}" class="px-4 py-2 hover:bg-gray-100 flex">
            <div class="text-gray-500 flex flex-wrap content-center">
              <x-heroicon-o-cog class="w-6 h-6" />
            </div>
            <div class="pl-3">
              <p class="text-sm font-medium text-gray-800 leading-none">
                Security
              </p>
              <p class="text-xs text-gray-500">
                Password, Two-factor Authentication
              </p>
            </div>
          </a>
        </div>

        <div class="mt-3 mb-3">
          <x-logout
            class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
            Sign Out
          </x-logout>
        </div>

      </div>
    </div>
  </div>

  @push('scripts')
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-analytics.js"></script>

    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-messaging.js"></script>

    <script>
      // Your web app's Firebase configuration
      // For Firebase JS SDK v7.20.0 and later, measurementId is optional
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
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
      firebase.analytics();

      const messaging = firebase.messaging();
      function startFCM() {
        messaging
          .requestPermission()
          .then(function () {
              return messaging.getToken()
          })
          .then(function (response) {
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
              url: '{{ route("profile.notif") }}',
              type: 'POST',
              data: {
                "token": response
              },
              dataType: 'text',
              success: function (response) {
                  alert('Token stored.');
              },
              error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
              },
            });
          }).catch(function (error) {
              alert(error);
          });
      }

      startFCM();

      messaging.onMessage(function (payload) {
          const title = payload.notification.title;
          const options = {
              body: payload.notification.body,
              icon: payload.notification.icon,
          };
          new Notification(title, options);
      });
    </script>
  @endpush
</x-layouts.app>
