<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Get the password reset request route
     *
     * @return string
     */
    protected function passwordRequestRoute()
    {
        return route('password.request');
    }

    /**
     * Get the email password reset link route
     *
     * @return string
     */
    protected function passwordEmailRoute()
    {
        return route('password.email');
    }

    /**
     * Get authenticated user redirect route
     *
     * @return string
     */
    protected function redirectIfAuthenticatedRoute()
    {
        return route('catalog');
    }

    /**
     * Test that a user can view the email password reset form
     *
     * @test
     * @return void
     */
    public function userCanViewAnEmailPasswordForm()
    {
        $response = $this->get($this->passwordRequestRoute());

        $response->assertSuccessful();
        $response->assertViewIs('auth.passwords.email');
    }

    /**
     * Test that a user cannot view email password reset form when authenticated
     *
     * @test
     * @return void
     */
    public function userCannotViewAnEmailPasswordFormWhenAuthenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get($this->passwordRequestRoute());

        $response->assertRedirect($this->redirectIfAuthenticatedRoute());
    }

    /**
     * Test that a user receives an email with a password reset link
     *
     * @test
     * @return void
     */
    public function userReceivesAnEmailWithAPasswordResetLink()
    {
        Notification::fake();
        $user = factory(User::class)->create([
            'email' => 'john@example.com',
        ]);

        $response = $this->post($this->passwordEmailRoute(), [
            'email' => 'john@example.com',
        ]);

        $this->assertNotNull($token = DB::table('password_resets')->first());
        Notification::assertSentTo($user, ResetPassword::class, function ($notification, $channels) use ($token) {
            return Hash::check($notification->token, $token->token) === true;
        });
    }

    /**
     * Test that a user does not receive email when they aren't registered
     *
     * @test
     * @return void
     */
    public function userDoesNotReceiveEmailWhenNotRegistered()
    {
        Notification::fake();

        $response = $this->from($this->passwordEmailRoute())->post($this->passwordEmailRoute(), [
            'email' => 'nobody@example.com',
        ]);

        $response->assertRedirect($this->passwordEmailRoute());
        $response->assertSessionHasErrors('email');
        Notification::assertNotSentTo(factory(User::class)->make(['email' => 'nobody@example.com']), ResetPassword::class);
    }

    /**
     * Test that email is required for password reset form
     *
     * @test
     * @return void
     */
    public function emailIsRequired()
    {
        $response = $this->from($this->passwordEmailRoute())->post($this->passwordEmailRoute(), []);

        $response->assertRedirect($this->passwordEmailRoute());
        $response->assertSessionHasErrors('email');
    }

    /**
     * Test that a valid email is required for password reset form
     *
     * @test
     * @return void
     */
    public function emailIsAValidEmail()
    {
        $response = $this->from($this->passwordEmailRoute())->post($this->passwordEmailRoute(), [
            'email' => 'invalid-email',
        ]);

        $response->assertRedirect($this->passwordEmailRoute());
        $response->assertSessionHasErrors('email');
    }
}
