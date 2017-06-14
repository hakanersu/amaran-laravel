<?php 
namespace Xuma\Amaran;

use Illuminate\Events\Dispatcher;

class AmaranViewBinder implements ViewBinder
{

    /**
     * @var Dispatcher
     */
    private $event;

    public function __construct(Dispatcher $event)
    {
        $this->event = $event;
    }

    /**
     * Bind the given JavaScript to the
     * view using Laravel event listeners
     *
     * @param $amaran The ready-to-go JS
     */
    public function bind($amaran)
    {
        $this->event->listen("composing: amaran::javascript", function () use ($amaran) {
            echo $amaran;
        });
    }
}
