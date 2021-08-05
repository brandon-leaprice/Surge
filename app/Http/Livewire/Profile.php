<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public User $user;
    public $avatar;

    protected $rules = [
        'user.username' => 'max:24',
        'user.about' => 'max:140',
        'user.birthday' => 'sometimes',
        'avatar' => 'nullable|image|max:1000',
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }



    public function save()
    {
        $this->validate();

        $this->user->save();

        if($this->avatar)
        {
            $this->user->avatar = $this->avatar->store('/', 'avatars');
            $this->user->save();
        }

        $this->emitSelf('notify-saved');

    }

    public function render()
    {
        return view('livewire.profile')
            ->layout('layouts.auth');
    }
}
