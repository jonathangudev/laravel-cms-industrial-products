<?php

namespace App\Mail;

use App\Company;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class WelcomeUser extends Mailable implements ShouldQueue
{
    use SerializesModels;

    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'database';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'emails';

    /**
     * The user instance.
     *
     * @var User
     */
    protected $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Company $company
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'userName' => $this->user->name,
            'userEmail' => $this->user->email,

            'verificationLink' => $this->verificationUrl($this->user),
            'loginUrl' => route('login'),
            'passwordResetLink' => route('password.reset', Password::broker()->createToken($this->user)),
        ];

        if ($company = $this->user->company) {
            $data = array_merge($data, [
                'companyName' => $company->name,
                'companyLogo' => Storage::disk('restricted')->url($company->logo),
            ]);
        }

        return $this->markdown('emails.welcome-user')->with($data);
    }

    /**
     * Get the email verification URL for the user.
     *
     * @param  User $user
     * @return string
     */
    protected function verificationUrl($user)
    {
        return URL::temporarySignedRoute(
            'verification.verify', Carbon::now()->addMinutes(60), ['id' => $user->getKey()]
        );
    }
}
