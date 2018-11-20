<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Get a password reset token
     *
     * @param App\User $user
     * @return void
     */
    protected function getValidToken($user)
    {
        return Password::broker()->createToken($user);
    }

    /**
     * Get password reset route
     *
     * @param string $token
     * @return string
     */
    protected function passwordResetGetRoute($token)
    {
        return route('password.reset', $token);
    }

    /**
     * Get the password reset path
     *
     * @return string
     */
    protected function passwordResetPostRoute()
    {
        return '/password/reset';
    }

    /**
     * Get successful password reset route
     *
     * @return string
     */
    protected function successfulPasswordResetRoute()
    {
        return route('catalog');
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
     * Test that a user can view the password reset form
     *
     * @test
     * @return void
     */
    public function userCanViewAPasswordResetForm()
    {
        $user = factory(User::class)->create();

        $response = $this->get($this->passwordResetGetRoute($token = $this->getValidToken($user)));

        $response->assertSuccessful();
        $response->assertViewIs('auth.passwords.reset');
        $response->assertViewHas('token', $token);
    }

    /**
     * Test that a user cannot view reset form when authenticated
     *
     * @test
     * @return void
     */
    public function userCannotViewAPasswordResetFormWhenAuthenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get($this->passwordResetGetRoute($this->getValidToken($user)));

        $response->assertRedirect($this->redirectIfAuthenticatedRoute());
    }

    /**
     * Test that a user can reset password with a valid token
     *
     * @test
     * @return void
     */
    public function userCanResetPasswordWithValidToken()
    {
        Event::fake();
        $user = factory(User::class)->create();

        $response = $this->post($this->passwordResetPostRoute(), [
            'token' => $this->getValidToken($user),
            'email' => $user->email,
            'password' => 'new-awesome-password',
            'password_confirmation' => 'new-awesome-password',
        ]);

        $response->assertRedirect($this->successfulPasswordResetRoute());
        $this->assertEquals($user->email, $user->fresh()->email);
        $this->assertTrue(Hash::check('new-awesome-password', $user->fresh()->password));
        $this->assertAuthenticatedAs($user);
        Event::assertDispatched(PasswordReset::class, function ($e) use ($user) {
            return $e->user->id === $user->id;
        });
    }

    /**
     * Test that a user cannot reset password with invalid token
     *
     * @test
     * @return void
     */
    public function userCannotResetPasswordWithInvalidToken()
    {
        $invalidToken = 'invalid-token';
        $user = factory(User::class)->create([
            'password' => bcrypt('old-password'),
        ]);

        $response = $this->from($this->passwordResetGetRoute($invalidToken))->post($this->passwordResetPostRoute(), [
            'token' => $invalidToken,
            'email' => $user->email,
            'password' => 'new-awesome-password',
            'password_confirmation' => 'new-awesome-password',
        ]);

        $response->assertRedirect($this->passwordResetGetRoute($invalidToken));
        $this->assertEquals($user->email, $user->fresh()->email);
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
        $this->assertGuest();
    }

    /**
     * Test that a user cannot reset password without providing a new one
     *
     * @test
     * @return void
     */
    public function userCannotResetPasswordWithoutProvidingANewPassword()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('old-password'),
        ]);

        $response = $this->from($this->passwordResetGetRoute($token = $this->getValidToken($user)))->post($this->passwordResetPostRoute(), [
            'token' => $token,
            'email' => $user->email,
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertRedirect($this->passwordResetGetRoute($token));
        $response->assertSessionHasErrors('password');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertEquals($user->email, $user->fresh()->email);
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
        $this->assertGuest();
    }

    /**
     * Test that a user cannot reset password with proving email
     *
     * @test
     * @return void
     */
    public function userCannotResetPasswordWithoutProvingAnEmail()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('old-password'),
        ]);

        $response = $this->from($this->passwordResetGetRoute($token = $this->getValidToken($user)))->post($this->passwordResetPostRoute(), [
            'token' => $token,
            'email' => '',
            'password' => 'new-awesome-password',
            'password_confirmation' => 'new-awesome-password',
        ]);

        $response->assertRedirect($this->passwordResetGetRoute($token));
        $response->assertSessionHasErrors('email');
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertEquals($user->email, $user->fresh()->email);
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
        $this->assertGuest();
    }
}
