<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('تحديث كلمة المرور') }}
    </x-slot>

    <x-slot name="description">
        {{-- {{ __('Ensure your account is using a long, random password to stay secure.') }} --}}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('كلمة المرور الحالية') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full"
                wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('كلمة المرور الجديدة') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password"
                autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('تأكيد كلمة المرور الجديدة ') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full"
                wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="ml-3" on="saved">
            {{ __('تم الحفظ') }}
        </x-action-message>

        <x-button
            class="py-2 px-4 bg-green-700 text-white main-font shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-75 transition-all">
            {{ __('حفظ') }}
        </x-button>
    </x-slot>
</x-form-section>
