<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class MakeAdmin extends Component
{
    private $user;
    public $user_id;
    public $isAdmin;
    public function mount()
    {
        $this->user = User::find($this->user_id);
        $this->isAdmin = $this->user->admin;
    }
    public function makeAdmin($user_id)
    {
        if (auth()->user() != null && auth()->user()->admin) {
            $this->user = User::find($this->user_id);
            $this->user->update([
                'admin' => true,
            ]);
            $this->isAdmin = true;
        } else {
            return redirect('/');
        }
    }
    public function removeAdmin($user_id)
    {
        if (auth()->user() != null && auth()->user()->admin) {
            $this->user = User::find($this->user_id);
            $this->user->update([
                'admin' => false,
            ]);
            $this->isAdmin = false;
        } else {
            return redirect('/');
        }
    }
    public function render()
    {
        return view('livewire.make-admin');
    }
}
