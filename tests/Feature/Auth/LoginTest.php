<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Get successful login route
     *
     * @return string
     */
    protected function successfulLoginRoute()
    {
        return route('catalog');
    }

    /**
     * Get login route
     *
     * @return string
     */
    protected function loginRoute()
    {
        return route('login');
    }

    /**
     * Get logout route
     *
     * @return string
     */
    protected function logoutRoute()
    {
        return route('logout');
    }

    /**
     * Get successful logout path
     *
     * @return string
     */
    protected function successfulLogoutPath()
    {
        return '/';
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
     * Test that a user can view the login form
     *
     * @test
     * @return void
     */
    public function userCanViewALoginForm()
    {
        $response = $this->get($this->loginRoute());

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    /**
     * Test that an authenticated user is redirected to the catalog
     *
     * @test
     * @return void
     */
    public function userCannotViewALoginFormWhenAuthenticated()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get($this->loginRoute());

        $response->assertRedirect($this->redirectIfAuthenticatedRoute());
    }

    /**
     * Test that a user can login
     *
     * @test
     * @return void
     */
    public function userCanLoginWithCorrectCredentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'ipsa-scientia-pontentia-est'),
        ]);

        $response = $this->post($this->loginRoute(), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect($this->successfulLoginRoute());
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test that the system can remember a user with a cookie stored token
     *
     * @test
     * @return void
     */
    public function rememberMe()
    {
        $user = factory(User::class)->create([
            'id' => random_int(1, 100),
            'password' => bcrypt($password = 'ipsa-scientia-pontentia-est'),
        ]);

        $response = $this->post($this->loginRoute(), [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
        ]);

        $response->assertRedirect($this->successfulLoginRoute());
        $response->assertCookie(Auth::guard()->getRecallerName(), vsprintf('%s|%s|%s', [
            $user->id,
            $user->getRememberToken(),
            $user->password,
        ]));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test that invalid passwords don't work
     *
     * @test
     * @return void
     */
    public function userCannotLoginWithIncorrectPassword()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('ipsa-scientia-pontentia-est'),
        ]);

        $response = $this->from($this->loginRoute())->post($this->loginRoute(), [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect($this->loginRoute());
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /**
     * Test that invalid emails don't work
     *
     * @test
     * @return void
     */
    public function userCannotLoginWithEmailThatDoesNotExist()
    {
        $response = $this->from($this->loginRoute())->post($this->loginRoute(), [
            'email' => 'nobody@example.com',
            'password' => 'ipsa-scientia-pontentia-est',
        ]);

        $response->assertRedirect($this->loginRoute());
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /**
     * Test that users are able to log out
     *
     * @test
     * @return void
     */
    public function userCanLogout()
    {
        $this->be(factory(User::class)->create());
        $response = $this->post($this->logoutRoute());

        $response->assertRedirect($this->successfulLogoutPath());
        $this->assertGuest();
    }

    /**
     * Test that a user cannot log out when they aren't authenticated
     *
     * @test
     * @return void
     */
    public function userCannotLogoutWhenNotAuthenticated()
    {
        $response = $this->post($this->logoutRoute());

        $response->assertRedirect($this->successfulLogoutPath());
        $this->assertGuest();
    }

    /**
     * Ensure that login rate limiting works
     *
     * @test
     * @return void
     */
    public function userCannotMakeMoreThanFiveAttemptsInOneMinute()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'ipsa-scientia-pontentia-est'),
        ]);

        foreach (range(0, 5) as $_) {
            $response = $this->from($this->loginRoute())->post($this->loginRoute(), [
                'email' => $user->email,
                'password' => 'invalid-password',
            ]);
        }

        $response->assertRedirect($this->loginRoute());
        $response->assertSessionHasErrors('email');
        $this->assertContains(
            'Too many login attempts.',
            collect($response
                    ->baseResponse
                    ->getSession()
                    ->get('errors')
                    ->getBag('default')
                    ->get('email')
            )->first()
        );
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }
}
