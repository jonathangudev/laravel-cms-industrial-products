<?php

namespace App\Events\Pages;

use App\Pages\HomePage;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HomePageCreating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var HomePage $homePage
     */
    public $homePage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(HomePage $homePage)
    {
        $this->homePage = $homePage;
    }
}
