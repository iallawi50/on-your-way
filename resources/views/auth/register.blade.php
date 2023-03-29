<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        {{-- <x-validation-errors class="mb-4" /> --}}

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" class="text-right" value="{{ __('الاسم') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>
           @error('name')
            <span class="text-red-500 text-right" dir="ltr">يرجى التحقق من كتابة الاسم</span>
            @enderror
            <div class="mt-4">
                <x-label for="email" class="text-right" value="{{ __('البريد الالكتروني للكلية التقنية') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
            </div>
            @error('email')
            <span class="text-red-500 text-right" dir="ltr"> @tvtc.edu.sa يرجى التحقق من البريد و انه متبوع بـ </span>
            @enderror
            @error('email')
            <div>
                <span class="text-red-500 text-right" dir="ltr"> {{ $message }}</span>
            </div>
            @enderror

            <div class="mt-4">
                <x-label for="mobile" class="text-right" value="{{ __('رقم الجوال') }}" />
                <x-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile')"
                    required autocomplete="username" />
            </div>
           @error('mobile')
            <span class="text-red-500 text-right" dir="ltr">يرجى التحقق من صحة رقم الجوال</span>
            @enderror

            <div class="mt-4">
                <x-label for="password" class="text-right" value="{{ __('كلمة المرور') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>
           @error('password')
            <span class="text-red-500 text-right" dir="ltr">يرجى التحقق من تطابق كلمة المرور وانه لايقل طوله عن 8 خانات</span>
            @enderror
            <div class="mt-4">
                <x-label for="password_confirmation" class="text-right" value="{{ __('تأكيد كلمة المرور') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('هل انت مسجل من قبل ؟ اضغط هنا') }}
                </a>

                <x-button
                    class="ml-4 py-2 px-4 bg-green-700 text-white   shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-75 transition-all">
                    {{ __('تسجيل') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
