<?php

namespace CoreProc\NotificationChannels\Telerivet\Events;

use CoreProc\NotificationChannels\Telerivet\TelerivetMessage;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Events\Dispatchable;

class TelerivetSmsSent
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
     * @var Response
     */
    public $response;

    /**
     * Create a new event instance.
     *
     * @param object $notifiable
     * @param TelerivetMessage $telerivetMessage
     * @param Response $response
     */
    public function __construct($notifiable, TelerivetMessage $telerivetMessage, Response $response)
    {
        $this->notifiable = $notifiable;
        $this->telerivetMessage = $telerivetMessage;
        $this->response = $response;
    }
}
