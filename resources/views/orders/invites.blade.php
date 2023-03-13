<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('الدعوات') }}
            <p class="text-red-500 text-sm">اضغط انهاء العملية للشخص الذي قام بتوصيلك فقط بعد التوصيل</p>
        </h2>
    </x-slot>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

        @foreach ($orders as $order)
            <div>
                <div class="max-w-auto flex flex-col h-200   bg-white overflow-hidden shadow-lg p-4">
                    <p class="text-orange-500">{{ $order->created_at->DiffForHumans() }}</p>
                    <p>الدعوة من : {{ App\Models\User::find($order->user_id)->name }}</p>
                    <p>رقم الجوال : {{ App\Models\User::find($order->user_id)->mobile }}</p>
                </div>
                <div class="bg-gray-200 flex justify-between max-w-auto">
                    <a href="tel:{{ App\Models\User::find($order->user_id)->mobile }}" role="button"
                        class="py-2 px-4 bg-green-700 ml-3 text-white shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-75 transition-all	">
                        اتصال
                    </a>
                    @livewire('log-update', ['log' => $order->id], key($order->id))
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
