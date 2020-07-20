<?php

namespace CoreProc\NotificationChannels\Telerivet\Events;

use CoreProc\NotificationChannels\Telerivet\TelerivetMessage;
use Illuminate\Foundation\Events\Dispatchable;

class TelerivetSmsSending
{
    use Dispatchable;

    /**
     * @var TelerivetMessage
     */
    public $telerivetMessage;

    /**
     * Create a new event instance.
     *
     * @param TelerivetMessage $telerivetMessage
     */
    public function __construct(TelerivetMessage $telerivetMessage)
    {
        $this->telerivetMessage = $telerivetMessage;
    }
}
