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
        $data =  $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:passwordConfirmation',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Hash::make($data['password']),
        ]);

        \Auth::login($user);

        return $this->redirect('/');
    }


    public function render()
    {
        return view('livewire.auth.register')
            ->extends('layouts.app');
    }
}
