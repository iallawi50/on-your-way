<div>
    @if ($isAdmin)
    <button wire:model="make-admin" wire:click="removeAdmin({{$user_id}})"
        class="px-3 py-2 flex justify-center items-center  bg-red-700 text-white shadow-md hover:bg-red-600 focus:outline-none
        focus:ring-2 focus:ring-red-300 focus:ring-opacity-75 transition-all">استبعاده من الادارة
        </button>
    @else
        <button wire:model="make-admin" wire:click="makeAdmin({{$user_id}})"
        class="px-3 py-2 flex justify-center items-center  bg-green-700 text-white shadow-md hover:bg-green-600 focus:outline-none
        focus:ring-2 focus:ring-green-300 focus:ring-opacity-75 transition-all">تعيينه
        مدير</button>
    @endif

</div>
