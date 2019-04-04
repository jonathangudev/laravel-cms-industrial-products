<?php

namespace App\Events\Pages;

use App\Pages\AboutUsPage;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AboutUsPageCreating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var AboutUsPage $aboutUsPage
     */
    public $aboutUsPage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(AboutUsPage $aboutUsPage)
    {
        $this->aboutUsPage = $aboutUsPage;
    }
}
