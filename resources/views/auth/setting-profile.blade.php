<x-layouts.app :title="__('Profile')">
  <div class="py-5">
    <div class="max-w-7xl sm:max-w-md mx-auto sm:px-6 md:px-6 lg:px-8 xl:px-8">
      <div class="shadow-md overflow-hidden sm:rounded-md">

        <x-form action="{{ route('setting.profile') }}" has-files novalidate autocomplete="off">
          @method('PUT')
          @csrf
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <div class="block">
              <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                <!-- Photo File Input -->
                <input type="file" name="image" class="hidden" x-ref="photo" x-on:change="
                    photoName = $refs.photo.files[0].name;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                      photoPreview = e.target.result;
                    };
                    reader.readAsDataURL($refs.photo.files[0]);
                  ">

                <label class="block font-medium text-sm text-center text-gray-700" for="photo">
                  Profile Picture
                </label>

                <div class="text-center">
                  <!-- Current Profile Photo -->
                  <div class="mt-2" x-show="! photoPreview">
                    <img class="h-36 w-36 rounded-full mx-auto" alt="profile" src="{{ $user->getImage() }}" />
                  </div>

                  <!-- New Profile Photo Preview -->
                  <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block w-40 h-40 rounded-full m-auto shadow"
                      x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'"
                      style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                    </span>
                  </div>
                  <x-error field="image" class="mt-1 font-medium text-sm text-red-600" />

                  <button type="button" x-on:click.prevent="$refs.photo.click()"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3">
                    Select New Picture
                  </button>
                </div>
              </div>
            </div>

            <!-- Fullname -->
            <div class="block">
              <x-label for="fullname" class="block font-medium text-sm text-gray-700" />
              @error('fullname')
                @php
                    $class = "mt-1 block w-full rounded-md border-red-300 shadow-sm focus:border-red-300 focus:ring focus:ring-red-300 focus:ring-opacity-50";
                @endphp
              @else
                @php
                    $class = "mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-300 focus:ring-opacity-50";
                @endphp
              @endif
              <x-input id="fullname" name="fullname" required autofocus :value="old('fullname', $user->fullname)" :class="$class" />
              <x-error field="fullname" class="mt-1 font-medium text-sm text-red-600" />
            </div>

            <!-- Username -->
            <div class="block">
              <x-label for="username" class="block font-medium text-sm text-gray-700" />
              @error('username')
                @php
                    $class = "mt-1 block w-full rounded-md border-red-300 shadow-sm focus:border-red-300 focus:ring focus:ring-red-300 focus:ring-opacity-50";
                @endphp
              @else
                @php
                    $class = "mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-300 focus:ring-opacity-50";
                @endphp
              @endif
              <x-input id="username" name="username" required :value="old('username', $user->username)" :class="$class" />
              <x-error field="username" class="mt-1 font-medium text-sm text-red-600" />
            </div>

            <!-- email -->
            <div class="block">
              <x-label for="email" class="block font-medium text-sm text-gray-700" />
              @error('email')
                @php
                    $class = "mt-1 block w-full rounded-md border-red-300 shadow-sm focus:border-red-300 focus:ring focus:ring-red-300 focus:ring-opacity-50";
                @endphp
              @else
                @php
                    $class = "mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-300 focus:ring-opacity-50";
                @endphp
              @endif
              <x-input id="email" name="email" type="email" required :value="old('email', $user->email)" :class="$class" />
              <x-error field="email" class="mt-1 font-medium text-sm text-red-600" />
            </div>

            <!-- Phone Number -->
            <div class="block">
              <x-label for="phone" class="block font-medium text-sm text-gray-700" />
              @error('phone')
                @php
                    $class = "mt-1 block w-full rounded-md border-red-300 shadow-sm focus:border-red-300 focus:ring focus:ring-red-300 focus:ring-opacity-50";
                @endphp
              @else
                @php
                    $class = "mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-300 focus:ring-opacity-50";
                @endphp
              @endif
              <x-input id="phone" name="phone" required :value="old('phone', $user->phone)" :class="$class" />
              <x-error field="phone" class="mt-1 font-medium text-sm text-red-600" />
            </div>
          </div>

          <div class="px-4 py-5 bg-gray-50 sm:p-6">
            <a href="{{ route('profile') }}"
              class="items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-gray-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
              Back
            </a>

            <button type="submit"
              class="items-center justify-center float-right px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
              Update
            </button>
          </div>
        </x-form>
      </div>
    </div>
  </div>
</x-layouts.app>
