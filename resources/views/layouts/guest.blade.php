<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- title -->
    <title>{{ config("app.name", "Laravel") }}</title>

    <!-- favicon -->
    <!-- https://realfavicongenerator.net/ -->
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="{{ asset('favicon/apple-touch-icon.png') }}"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="{{ asset('favicon/favicon-32x32.png') }}"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="{{ asset('favicon/favicon-16x16.png') }}"
    />
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}" />
    <link
      rel="mask-icon"
      href="{{ asset('favicon/safari-pinned-tab.svg') }}"
      color="#ef3b2d"
    />
    <meta name="msapplication-TileColor" content="#ef3b2d" />
    <meta name="theme-color" content="#ffffff" />

    <!-- Fonts -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
    />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />

    @bukStyles
  </head>

  <body>
    <div class="font-sans text-gray-900 antialiased">
      {{ $slot }}
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @bukScripts
  </body>
</html>
