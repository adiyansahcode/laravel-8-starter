<div x-data="{ show: true }">
  <div class="relative">
    <input placeholder="" :type="show ? 'password' : 'text'" {{
      $attributes->merge([
        'class' => ''
      ])
    }}>
    <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
      <x-heroicon-o-eye x-bind:class="{ 'hidden': !show, 'block': show }" class="h-6 text-gray-700"
        @click="show = !show" />
      <x-heroicon-o-eye-off x-bind:class="{ 'hidden': show, 'block': !show }" class="h-6 text-gray-700"
        @click="show = !show" x-cloak />
    </div>
  </div>
</div>

<style>
  [x-cloak] {
    display: none;
  }

</style>
