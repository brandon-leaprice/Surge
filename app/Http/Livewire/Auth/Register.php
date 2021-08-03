<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{

    public $name;
    public $email;
    public $password;
    public $passwordConfirmation;


    public function register()
    {
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => \Hash::make($this->password),
        ]);
    }


    public function render()
    {
        return view('livewire.auth.register')
            ->extends('layouts.app');
    }
}
