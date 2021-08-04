<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Login extends Component
{

    public $email;
    public $password;


    public function login()
    {
        $data = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        return auth()->validate($data) ? $this->redirect('/profile') : $this->redirect('/login');
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.base');
    }
}
