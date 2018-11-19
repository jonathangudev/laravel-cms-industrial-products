<?php

namespace Tests\Unit\Http\Middleware;

use App\Http\Middleware\Authenticate as AuthenticateMiddleware;
use App\User;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test that an unauthenticated user is redirected to login
     *
     * @return  void
     */
    public function testThatUnauthenticatedUsersAreRedirectedToLogin()
    {
        $request = Request::create('/catalog', 'GET');
        $auth = $this->createMock(Auth::class);
        $auth->method('check')
            ->willReturn(false);

        $middleware = new AuthenticateMiddleware($auth);
        $response = $middleware->handle($request, function () {});
        var_dump($response->toArray());

        $response->assertRedirect('/login');
    }

    /**
     * Test that an authenticated user is not redirected
     *
     * @return  void
     */
    public function testThatUnauthenticatedUsersAreNotRedirectedToLogin()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');
    }
}
