<?php

namespace CoreProc\NotificationChannels\Telerivet\Events;

use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Events\Dispatchable;

class TelerivetSmsSent
{
    use Dispatchable;

    /**
     * @var Response
     */
    public $response;

    /**
     * Create a new event instance.
     *
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }
}
