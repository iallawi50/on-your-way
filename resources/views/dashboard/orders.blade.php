<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

        @foreach ($orders as $order)
            <div class="max-w-auto h-200 rounded bg-white overflow-hidden shadow-lg">


                <div class="px-6 py-4">
                    <div class="status flex justify-between">

                        <span class={{$order->status ? "text-green-500" : 'text-red-500'}}>{{ $order->status ? 'مكتمل' : 'غير مكتمل' }}</span>
                        <span class="text-gray-500">{{ $order->created_at->diffForHumans() }}</span>

                    </div>
                    <div class="font-bold text-xl my-4"><a href="/orders/"></a>
                    </div>
                    <p class="text-black text-base">
                        الاسم : <span>{{ $order->user->name }}</span>

                    </p>
                    <p class="text-black text-base">
                        العنوان : {{ $order->description }}
                    </p>
                    <p class="text-black text-base">
                        رقم الجوال : {{ $order->user->mobile }}
                    </p>
                    <a class="text-blue-500" href="{{ $order->url }}" target="_blank"> رابط الموقع : اضغط هنا</a>
                    <div class="border-b my-5 border-solid border-gray-700">
                    </div>
                    كان مدعو من قبل
                    @foreach ($order->log as $log)
                        <p class="{{ $log->status ? 'text-green-600' : '' }}">
                            {{ App\Models\User::find($log->user_id)->email }}</p>
                    @endforeach

                </div>

            </div>
        @endforeach

    </div>
</x-app-layout>
