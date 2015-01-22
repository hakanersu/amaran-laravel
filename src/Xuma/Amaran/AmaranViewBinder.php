<?php namespace Xuma\Amaran;

use Illuminate\Events\Dispatcher;

class AmaranViewBinder implements ViewBinder {

    /**
     * @var Dispatcher
     */
    private $event;

    /**
     * @var string
     */
    private $viewToBindVariables;

    /**
     * @param Dispatcher $event
     * @param $viewToBindVariables
     */
    function __construct(Dispatcher $event, $viewToBindVariables)
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
        $this->event->listen("composing: {$this->viewToBindVariables}", function() use ($amaran)
        {
            echo "<script>{$amaran}</script>";
        });
    }
    
}