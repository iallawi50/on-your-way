<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('طلب توصيل') }}
        </h2>
    </x-slot>
    <header class="flex justify-between mb-10">
        <div class="text-gray-500">
            <a href="/">العودة للطلبات</a>
        </div>

        {{--
        <div>
            <a href="/projects/create" role="button"
                class="py-2 px-4 bg-purple-600 text-white font-semibold rounded shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:ring-opacity-75">اضف
                مشروع</a>
        </div> --}}

    </header>


    <form action="/orders" method="POST" class="mt-3">
        @csrf
        <div class="flex flex-col">
            <label for="description">عنوان المنزل</label>
            <input type="text" name="description" placeholder="مثلاً: قرية القرين - بالقرب من الدوار "
                class="w-full border-gray-300 focus:border-green-700 focus:ring-green-700 rounded-md shadow-sm">
        </div>
        @error('description')
            <p class="text-sm text-red-600">الرجاء التحقق من العنوان</p>
        @enderror
        <div class="flex flex-col mt-5">
            <label for="url">رابط عنوان المنزل</label>
            <input type="text" name="url"
                class="w-full border-gray-300 focus:border-green-700 focus:ring-green-700 rounded-md shadow-sm">
        </div>


        @error('url')
            <p class="text-sm text-red-600">الرجاء التحقق من الرابط</p>
        @enderror

        <button type="submit"
            class="p-1 px-2 mt-3 rounded-md bg-green-700 hover:bg-green-600 active:bg-green-700 text-white">اطلب</button>

    </form>

</x-app-layout>
