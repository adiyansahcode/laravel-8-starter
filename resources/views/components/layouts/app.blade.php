<x-layouts.base :title="$title">
  <div class="min-h-screen bg-gray-100">
    <x-layouts.navigation />
    {{ $slot }}
  </div>
</x-layouts.base>
