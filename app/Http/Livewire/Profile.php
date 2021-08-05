<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $username = '';
    public $about = '';
    public $birthday = null;
    public $newAvatar;

    public function mount()
    {
        $this->username = auth()->user()->username;
        $this->about = auth()->user()->about;
        $this->birthday = Carbon::createFromFormat('Y-m-d', auth()->user()->birthday)->format('d/m/y');
    }



    public function save()
    {
        $profileData = $this->validate([
            'username' => 'max:24',
            'about' => 'max:140',
            'birthday' => 'sometimes',
            'newAvatar' => 'image|max:1000'
        ]);

        $filename = $this->newAvatar->store('/', 'avatars');

        $user = \Auth::user();

        $user->username = $profileData['username'];
        $user->about = $profileData['about'];
        $user->birthday = Carbon::createFromFormat('d/m/Y', $profileData['birthday'])->format('Y-m-d');
        $user->avatar = $filename;

        $user->save();

        $this->emitSelf('notify-saved');
    }

    public function render()
    {
        return view('livewire.profile')
            ->layout('layouts.auth');
    }
}
