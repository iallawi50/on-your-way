<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        {{-- <x-validation-errors class="mb-4" /> --}}

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" class="text-right" value="{{ __('البريد الالكتروني') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>
            @error('email')
            <span class="text-red-600">يرجى التحقق من الايميل او كلمة المرور</span>
            @enderror

            <div class="mt-4">
                <x-label for="password" class="text-right" value="{{ __('كلمة المرور') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center flex-row-reverse">
                    <span class="ml-2 text-sm text-gray-600">{{ __('تذكرني في المرة القادمة') }}</span>
                    <x-checkbox id="remember_me" name="remember" />
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('هل نسيت كلمة المرور ؟') }}
                    </a>
                @endif

                <x-button class="ml-4 py-2 px-4 bg-green-700 text-white   shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-75 transition-all">
                    {{ __('تسجيل دخول') }}

                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
