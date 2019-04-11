<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verification route name
     *
     * @var string
     */
    protected $verificationVerifyRouteName = 'verification.verify';

    /**
     * Get successful verification route
     *
     * @return string
     */
    protected function successfulVerificationRoute()
    {
        return route('catalog');
    }

    /**
     * Get the verification notice route
     *
     * @return string
     */
    protected function verificationNoticeRoute()
    {
        return route('verification.notice');
    }

    /**
     * Get a valid verification route for a user id
     *
     * @param int $id
     * @return string
     */
    protected function validVerificationVerifyRoute($id)
    {
        return URL::signedRoute($this->verificationVerifyRouteName, ['id' => $id]);
    }

    /**
     * Get an invalid verification route for a user id
     *
     * @param int $id
     * @return string
     */
    protected function invalidVerificationVerifyRoute($id)
    {
        return route($this->verificationVerifyRouteName, ['id' => $id]) . '?signature=invalid-signature';
    }

    /**
     * Get the verification resend route
     *
     * @return string
     */
    protected function verificationResendRoute()
    {
        return route('verification.resend');
    }

    /**
     * Get the login route
     *
     * @return string
     */
    protected function loginRoute()
    {
        return route('login');
    }

    /**
     * Ensure that a guest cannot see the verification notice
     *
     * @test
     * @return void
     */
    public function guestCannotSeeTheVerificationNotice()
    {
        $response = $this->get($this->verificationNoticeRoute());

        $response->assertRedirect($this->loginRoute());
    }

    /**
     * Test that an unverified user sees the verification notice
     *
     * @test
     * @return void
     */
    public function userSeesTheVerificationNoticeWhenNotVerified()
    {
        $user = factory(User::class)->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get($this->verificationNoticeRoute());

        $response->assertStatus(200);
        $response->assertViewIs('auth.verify');
    }

    /**
     * Test that a verified user is redirected to the catalog when
     * visiting the verification notice route
     *
     * @test
     * @return void
     */
    public function verifiedUserIsRedirectedToCatalogWhenVisitingVerificationNoticeRoute()
    {
        $user = factory(User::class)->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get($this->verificationNoticeRoute());

        $response->assertRedirect($this->successfulVerificationRoute());
    }

    /**
     * Test that a guest cannot see the veficiation verify route
     *
     * @test
     * @return void
     */
    public function guestCannotSeeTheVerificationVerifyRoute()
    {
        factory(User::class)->create([
            'id' => 1,
            'email_verified_at' => null,
        ]);

        $response = $this->get($this->validVerificationVerifyRoute(1));

        $response->assertRedirect($this->loginRoute());
    }

    /**
     * Test that a user cannot verify other users
     *
     * @test
     * @return void
     */
    public function userCannotVerifyOthers()
    {
        $user = factory(User::class)->create([
            'id' => 1,
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get($this->validVerificationVerifyRoute(2));

        $response->assertForbidden();
    }

    /**
     * Test verified user is redirected correctly
     *
     * @test
     * @return void
     */
    public function userIsRedirectedToCorrectRouteWhenAlreadyVerified()
    {
        $user = factory(User::class)->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get($this->validVerificationVerifyRoute($user->id));

        $response->assertRedirect($this->successfulVerificationRoute());
    }

    /**
     * Test that 403 is returned for invalid verification routes
     *
     * @test
     * @return void
     */
    public function forbiddenIsReturnedWhenSignatureIsInvalidInVerificationVerfyRoute()
    {
        $user = factory(User::class)->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get($this->invalidVerificationVerifyRoute($user->id));

        $response->assertStatus(403);
    }

    /**
     * Test that a user can verify themselves
     *
     * @test
     * @return void
     */
    public function userCanVerifyThemselves()
    {
        $user = factory(User::class)->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get($this->validVerificationVerifyRoute($user->id));

        $response->assertRedirect($this->successfulVerificationRoute());
        $this->assertNotNull($user->fresh()->email_verified_at);
    }

    /**
     * Test that a guest cannot resend a verification email
     *
     * @test
     * @return void
     */
    public function guestCannotResendAVerificationEmail()
    {
        $response = $this->get($this->verificationResendRoute());

        $response->assertRedirect($this->loginRoute());
    }

    /**
     * Test that a user is redirected correctly if already verified when visiting resend route
     *
     * @test
     * @return void
     */
    public function userIsRedirectedToCorrectRouteIfAlreadyVerifiedFromResendRoute()
    {
        $user = factory(User::class)->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get($this->verificationResendRoute());

        $response->assertRedirect($this->successfulVerificationRoute());
    }

    /**
     * Test that a user can resend their verification email
     *
     * @test
     * @return void
     */
    public function userCanResendAVerificationEmail()
    {
        Notification::fake();
        $user = factory(User::class)->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)
            ->from($this->verificationNoticeRoute())
            ->get($this->verificationResendRoute());

        Notification::assertSentTo($user, VerifyEmail::class);
        $response->assertRedirect($this->verificationNoticeRoute());
    }
}
