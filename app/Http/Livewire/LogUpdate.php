<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Orderlog;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LogUpdate extends Component
{
    private $order;
    public $log;
    public $completed;
    public function mount()
    {
        $this->order = Orderlog::find($this->log);
        $this->completed = $this->order->status;
    }
    public function update($log)
    {
        $this->order = Orderlog::find($this->log);

        if (auth()->user()->id == $this->order->order_user_id) {
            $this->order->update([
                'status' => true
            ]);
            $this->completed = $this->order->status;
            Order::find($this->order->order_id)->update([
                'status' => $this->completed,
            ]);
        }
    }
    public function render()
    {
        return view('livewire.log-update');
    }
}
