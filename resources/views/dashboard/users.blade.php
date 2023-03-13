<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('المستخدمين') }}
        </h2>
    </x-slot>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-center text-sm font-light">
                        <thead class="border-b bg-blue-500 font-medium text-white">
                            <tr>
                                <th scope="col" class=" px-6 py-4">#</th>
                                <th scope="col" class=" px-6 py-4">الاسم</th>
                                <th scope="col" class=" px-6 py-4">البريد الالكتروني</th>
                                <th scope="col" class=" px-6 py-4">رقم الجوال</th>
                                <th scope="col" class=" px-6 py-4">الطلبات</th>
                                <th scope="col" class=" px-6 py-4">الدعوات المرسلة</th>
                                <th scope="col" class=" px-6 py-4">الدعوات المستقبلة</th>
                                <th scope="col" class=" px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <div class="flex mb-5">
                                <form action="/admin/dashboard/users/search" class="flex mb-12" method="GET">
                                    <input type="text" class="w-full border-0 focus:ring-0" name="search"
                                        placeholder="البحث من خلال الرقم التدريبي او الاسم" />
                                    <button type="submit" class="p-3 text-white bg-teal-500 shadow-md hover:bg-teal-600 focus:outline-none focus:ring-teal-300 focus:bg-teal-400 transition-all">ابحث</button>
                                </form>
                            </div>
                            @foreach ($users as $user)
                                <tr class="border-b {{$user->id % 2 == 0 ? 'bg-white' : 'bg-gray-200'}} text-black">
                                    <td class="whitespace-nowrap  px-6 py-4 font-medium">{{ $user->id }}</td>
                                    <td class="whitespace-nowrap  px-6 py-4 ">{{ $user->name }}</td>
                                    <td class="whitespace-nowrap  px-6 py-4">{{ $user->email }}</td>
                                    <td class="whitespace-nowrap  px-6 py-4">{{ $user->mobile }}</td>
                                    <td class="whitespace-nowrap  px-6 py-4">{{ count($user->orders) }}</td>
                                    <td class="whitespace-nowrap  px-6 py-4">{{ count($user->orderlogs) }}</td>
                                    <td class="whitespace-nowrap  px-6 py-4">
                                        {{ count(App\Models\Orderlog::get()->where('order_user_id', $user->id)) }}</td>
                                        <td class="whitespace-nowrap">@livewire('make-admin', ['user_id' => $user->id], key($user->id))</td>
                                    </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
