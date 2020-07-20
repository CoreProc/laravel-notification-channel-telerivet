<?php

namespace CoreProc\NotificationChannels\Telerivet\Events;

use CoreProc\NotificationChannels\Telerivet\TelerivetMessage;
use Illuminate\Foundation\Events\Dispatchable;

class TelerivetSmsSending
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
     * Create a new event instance.
     *
     * @param object $notifiable
     * @param TelerivetMessage $telerivetMessage
     */
    public function __construct($notifiable, TelerivetMessage $telerivetMessage)
    {
        $this->notifiable = $notifiable;
        $this->telerivetMessage = $telerivetMessage;
    }
}
