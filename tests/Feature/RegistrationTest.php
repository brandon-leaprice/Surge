<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RegistrationTest extends TestCase
{

    use RefreshDatabase;


    public function test_can_see_register_component()
    {
        $this->get('/register')->assertSeeLivewire('auth.register');
    }

    public function test_can_register()
    {
        Livewire::test('auth.register')
            ->set('name', 'test')
            ->set('email', 'test@gmail.com')
            ->set('password', 'testing')
            ->set('passwordConfirmation', 'testing')
            ->call('register')
            ->assertRedirect('/');


        $this->assertTrue(User::whereEmail('test@gmail.com')->exists());

        $this->assertEquals('test@gmail.com', \Auth::user()->email);
    }

    public function test_name_is_required()
    {
        Livewire::test('auth.register')
            ->set('name', '')
            ->set('email', 'test@gmail.com')
            ->set('password', 'testing')
            ->set('passwordConfirmation', 'testing')
            ->call('register')
            ->assertHasErrors(['name' => 'required']);
    }

    public function test_email_is_required()
    {
        Livewire::test('auth.register')
            ->set('name', 'test')
            ->set('email', '')
            ->set('password', 'testing')
            ->set('passwordConfirmation', 'testing')
            ->call('register')
            ->assertHasErrors(['email' => 'required']);
    }

    public function test_email_is_not_taken()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => \Hash::make('testing')
        ]);

        Livewire::test('auth.register')
            ->set('name', 'test')
            ->set('email', 'test@gmail.com')
            ->set('password', 'testing')
            ->set('passwordConfirmation', 'testing')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);
    }

    public function test_password_is_required()
    {
        Livewire::test('auth.register')
            ->set('name', 'test')
            ->set('email', 'test@gmail.com')
            ->set('password', '')
            ->set('passwordConfirmation', 'testing')
            ->call('register')
            ->assertHasErrors(['password' => 'required']);
    }

    public function test_password_must_be_the_same_as_confirmation()
    {
        Livewire::test('auth.register')
            ->set('name', 'test')
            ->set('email', 'test@gmail.com')
            ->set('password', 'test')
            ->set('passwordConfirmation', 'testing')
            ->call('register')
            ->assertHasErrors(['password' => 'same']);
    }

    public function test_password_must_be_minimum_of_6_charters()
    {
        Livewire::test('auth.register')
            ->set('name', 'test')
            ->set('email', 'test@gmail.com')
            ->set('password', 'test')
            ->set('passwordConfirmation', 'testing')
            ->call('register')
            ->assertHasErrors(['password' => 'min']);
    }

}
