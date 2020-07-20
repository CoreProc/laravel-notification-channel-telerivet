<?php

namespace CoreProc\NotificationChannels\Telerivet\Events;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Foundation\Events\Dispatchable;

class TelerivetSmsFailed
{
    use Dispatchable;

    /**
     * @var RequestException
     */
    public $requestException;

    /**
     * Create a new event instance.
     *
     * @param RequestException $requestException
     */
    public function __construct(RequestException $requestException)
    {
        $this->requestException = $requestException;
    }
}
