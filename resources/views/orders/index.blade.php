<x-app-layout>

    <x-slot name="header">
        <h2 class=text-xl text-gray-800 leading-tight">
            {{ __('الرئيسية') }}
        </h2>
    </x-slot>
    <header class="flex justify-between mb-10">
        <div class="text-gray-500">
        </div>


        <div>
            <a href="/orders/create" role="button"
                class="py-2 px-4 bg-green-700 text-white rounded shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-75 transition-all	">اضف
                طلب جديد</a>
        </div>

    </header>


    <section>
        @if (count($orders) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @endif
        @forelse($orders as $order)
            <div class="max-w-auto h-200 rounded bg-white overflow-hidden shadow-lg">

                <div class="px-6 py-4">
                    <div class="status flex justify-between">
                        <span class="text-gray-500">{{ $order->user->name }}</span>

                        <span class="text-gray-500">{{ $order->created_at->diffForHumans() }}</span>

                    </div>
                    <div class="font-bold text-xl my-4"><a href="/orders/"></a>
                    </div>
                    <p class="text-gray-700 text-base card-mh">
                        {{ $order->description }}
                    </p>
                </div>
                @livewire('invite-button', ['order_id' => $order->id, 'order_url' => $order->url], key($order->id))

            </div>

            </div>

        @empty
            <div class="text-center">
                <p class="my-14 font-bold">قائمة الطلبات خالية</p>
                <a href="/orders/create" role="button"
                    class="py-2 px-4 bg-green-700 text-white   shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-75 transition-all	">
                    اطلب الان
                </a>
            </div>
        @endforelse

        @if (count($orders) > 0)
            </div>
        @endif

    </section>



</x-app-layout>
