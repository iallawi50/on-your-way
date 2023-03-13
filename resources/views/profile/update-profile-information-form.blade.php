<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('المعلومات الشخصية') }}
    </x-slot>

    <x-slot name="description">
        {{ __('يمكنك تحديث الاسم او البريد الالكتروني اذا لم يتم التحقق منه') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" wire:model="photo" x-ref="photo"
                    x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('الاسم') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('البريد الالكتروني للكلية') }}" />

            @if ($this->user->hasVerifiedEmail())
                <x-input id="email" type="text" disabled class="mt-1 block w-full" dir="ltr" value="{{ $this->user->email }}" />
            @else
                <x-input id="email" type="text" wire:model.defer="state.email" dir="ltr" class="mt-1 block w-full"
                    autocomplete="username" />
                <x-input-error for="email" class="mt-2" />

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                        !$this->user->hasVerifiedEmail())
                    <p class="text-sm mt-2">
                        {{ __('Your email address is unverified.') }}

                        <button type="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            wire:click.prevent="sendEmailVerification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if ($this->verificationLinkSent)
                        <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                @endif

            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="ml-3" on="saved">
            {{ __('تم الحفظ') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo" class="py-2 px-4 bg-green-700 text-white   shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-75 transition-all">
            {{ __('حفظ') }}
        </x-button>
    </x-slot>
</x-form-section>
