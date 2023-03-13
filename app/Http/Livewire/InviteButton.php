<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InviteButton extends Component
{
    private $order;
    public $order_url;
    public $order_id;
    public $invited;
    public $mobile = '05xxxxxxxx';
    public $isInvited = false;
    public function mount()
    {
        $this->invited = (bool)DB::table('orderlogs')
            ->where('user_id', auth()->user()->id)
            ->where('order_id', $this->order_id)->count();
        $this->order = Order::find($this->order_id);

        if ($this->invited || $this->order->user_id == auth()->user()->id) {

            $this->mobile = $this->order->user->mobile;
            $this->isInvited = true;
        }
    }
    public function sendInvite($order_id)
    {

        if (auth()->user() != null) {
            $this->order = Order::find($this->order_id);
            if ($this->order == null) {
                abort(404);
            }
            $this->invited =
                (bool)DB::table('orderlogs')
                    ->where('user_id', auth()->user()->id)
                    ->where('order_id', $this->order_id)->count();
            $this->mobile = $this->order->user->mobile;


            if ($this->invited == false) {
                DB::table('orderlogs')->insert([
                    'user_id' => auth()->user()->id,
                    'order_user_id' => $this->order->user->id,
                    'order_id' => $this->order_id,
                    'created_at' => Carbon::now(),

                ]);
                $this->isInvited = true;

                $this->mobile = $this->order->user->mobile;
            }
        }
    }

    public function done($order_id)
    {
        $this->order = Order::find($this->order_id);
        if ($this->order->user_id == auth()->user()->id) {
            $this->order->update([
                'status' => true,
            ]);
            return redirect('/');
        }
    }
    public function render()
    {
        return view('livewire.invite-button');
    }
}
