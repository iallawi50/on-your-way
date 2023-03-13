                <button role="button" wire:model="log-update" wire:click="update({{ $log }})" {{$this->completed ? 'disabled' : ''}}
                    class="py-2 px-4 bg-teal-700 text-white font-semibold shadow-md hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:ring-opacity-75 transition-all	">
                {{$this->completed ? "تم الانهاء" : "انهاء العملية"}}
                </button>
