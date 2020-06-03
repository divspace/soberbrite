<?php

namespace Tests\Feature\Auth;

use App\Database\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function registration_page_contains_livewire_component()
    {
        $this->get(route('register'))
            ->assertSuccessful()
            ->assertSeeLivewire('auth.register');
    }

    /** @test */
    public function is_redirected_if_already_logged_in()
    {
        $user = factory(User::class)->create();

        $this->be($user);

        $this->get(route('register'))
            ->assertRedirect(route('home'));
    }

    /** @test */
    function a_user_can_register()
    {
        Livewire::test('auth.register')
            ->set('email', 'tallstack@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('register')
            ->assertRedirect(route('home'));

        $this->assertTrue(User::whereEmail('tallstack@example.com')->exists());
        $this->assertSame('tallstack@example.com', Auth::user()->email);
    }

    /** @test */
    function email_is_required()
    {
        Livewire::test('auth.register')
            ->set('email', '')
            ->call('register')
            ->assertHasErrors(['email' => 'required']);
    }

    /** @test */
    function email_is_valid_email()
    {
        Livewire::test('auth.register')
            ->set('email', 'tallstack')
            ->call('register')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @test */
    function email_hasnt_been_taken_already()
    {
        factory(User::class)->create(['email' => 'tallstack@example.com']);

        Livewire::test('auth.register')
            ->set('email', 'tallstack@example.com')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    function see_email_hasnt_already_been_taken_validation_message_as_user_types()
    {
        factory(User::class)->create(['email' => 'tallstack@example.com']);

        Livewire::test('auth.register')
            ->set('email', 'smallstack@gmail.com')
            ->assertHasNoErrors()
            ->set('email', 'tallstack@example.com')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    function password_is_required()
    {
        Livewire::test('auth.register')
            ->set('password', '')
            ->set('password_confirmation', 'password')
            ->call('register')
            ->assertHasErrors(['password' => 'required']);
    }

    /** @test */
    function password_is_minimum_of_eight_characters()
    {
        Livewire::test('auth.register')
            ->set('password', 'secret')
            ->set('password_confirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['password' => 'min']);
    }

    /** @test */
    function password_matches_password_confirmation()
    {
        Livewire::test('auth.register')
            ->set('email', 'tallstack@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'not-password')
            ->call('register')
            ->assertHasErrors(['password' => 'same']);
    }
}
