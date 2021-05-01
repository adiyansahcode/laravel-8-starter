<x-bui-html :title="isset($title) ? $title . ' - ' . config('app.name') : ''">
  <x-slot name="head">
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

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />

    @bukStyles
  </x-slot>

  <div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <!-- Page Heading -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{ $header }}
      </div>
    </header>

    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>
  </div>

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
  @bukScripts
</x-bui-html>
