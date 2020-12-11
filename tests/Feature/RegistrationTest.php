<?php

namespace Tests\Feature;

use App\Mail\PleaseConfirmYourEmail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_confirmation_email_is_sent_upon_registration()
    {
        Mail::fake();
        $this->post('/register',[
            'name' => 'UserOne',
            'login' => 'UserOne',
            'email'=> 'UserOne@mail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);
        Mail::assertQueued(PleaseConfirmYourEmail::class);
    }
    /** пользователь может  подтвердить свои адрес электронной почты **/
    public function test_user_can_fully_confirm_their_email_addresses()
    {
        Mail::fake();

        $this->post('/register',[
            'name' => 'UserOne',
            'login' => 'UserOne',
            'email'=> 'UserOne@mail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);
        $user = User::whereName('UserOne')->first();
        $this->assertFalse($user->confirmed);
        $this->assertNotNull($user->confirmation_token);
        $this->get('/register/confirm?token='.$user->confirmation_token)->assertRedirect(route('blog'));
        tap($user->fresh(), function ($user) {
            $this->assertTrue($user->confirmed);
            $this->assertNull($user->confirmation_token);
        });
    }
    public function test_confirming_an_invalid_token()
    {
        $this->get(route('register.confirm', ['token' => 'invalid']))
            ->assertRedirect(route('blog'))
            ->assertSessionHas('flash', 'Unknown token.');
    }
}
