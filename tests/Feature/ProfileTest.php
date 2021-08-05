<?php

namespace Tests\Feature;

use App\Models\User;
use App\View\Components\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;


    function test_profile_can_see_livewire_component_on_profile()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/profile')
            ->assertSuccessful()
            ->assertSeeLivewire('profile');
    }



    function test_profile_info_is_pre_populated()
    {
        $user = User::factory()->create([
            'username' => 'foo',
            'about' => 'bar',
        ]);

        Livewire::actingAs($user)
            ->test('profile')
            ->assertSet('user.username', 'foo')
            ->assertSet('user.about', 'bar');
    }


    function test_message_is_shown_on_save()
    {
        $user = User::factory()->create([
            'username' => 'foo',
            'about' => 'bar',
        ]);

        Livewire::actingAs($user)
            ->test('profile')
            ->call('save')
            ->assertEmitted('notify-saved');
    }

    function test_can_upload_avatar()
    {
        $user = User::factory()->create();

        $file = UploadedFile::fake()->image('avatar.png');

        \Storage::fake('avatars');

        Livewire::actingAs($user)
            ->test('profile')
            ->set('upload', $file)
            ->call('save');
    }


    function test_can_update_profile()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('profile')
            ->set('user.username', 'foo')
            ->set('user.about', 'bar')
            ->call('save');

        $user->refresh();

        $this->assertEquals('foo', $user->username);
        $this->assertEquals('bar', $user->about);

    }

    function test_username_must_less_than_24_characters()
    {
         $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('profile')
            ->set('user.username', str_repeat('a', 25))
            ->set('user.about', 'bar')
            ->call('save')
            ->assertHasErrors(['user.username' => 'max']);
    }

    function test_about_must_less_than_140_characters()
    {
         $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('profile')
            ->set('user.username', 'foo')
            ->set('user.about', str_repeat('a', 141))
            ->call('save')
            ->assertHasErrors(['user.about' => 'max']);
    }
}
