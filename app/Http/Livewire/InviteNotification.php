<?php

namespace App\Http\Livewire;

use App\Models\Orderlog;
use Carbon\Carbon;
use Livewire\Component;

class InviteNotification extends Component
{
    public $user_id;
    public $orders;
    public $count;
    public function mount()
    {
        if (auth()->user() == null) return redirect('/login');
        $this->orders = Orderlog::latest()->whereDate('created_at', Carbon::today())->where('order_user_id', $this->user_id)->get();
        $this->count = count($this->orders);
    }
    public function render()
    {
        return view('livewire.invite-notification');
    }
}
