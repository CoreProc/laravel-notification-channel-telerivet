<?php

namespace CoreProc\NotificationChannels\Telerivet\Events;

use CoreProc\NotificationChannels\Telerivet\TelerivetMessage;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Foundation\Events\Dispatchable;

class TelerivetSmsFailed
{
    use Dispatchable;

    /**
     * @var object
     */
    public $notifiable;

    /**
     * @var TelerivetMessage
     */
    public $telerivetMessage;

    /**
     * @var RequestException
     */
    public $requestException;

    /**
     * Create a new event instance.
     *
     * @param object $notifiable
     * @param TelerivetMessage $telerivetMessage
     * @param RequestException $requestException
     */
    public function __construct($notifiable, TelerivetMessage $telerivetMessage, RequestException $requestException)
    {
        $this->notifiable = $notifiable;
        $this->telerivetMessage = $telerivetMessage;
        $this->requestException = $requestException;
    }
}
