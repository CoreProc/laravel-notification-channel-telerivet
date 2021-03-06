<?php

namespace CoreProc\NotificationChannels\Telerivet;

use CoreProc\NotificationChannels\Telerivet\Events\TelerivetSmsFailed;
use CoreProc\NotificationChannels\Telerivet\Events\TelerivetSmsSending;
use CoreProc\NotificationChannels\Telerivet\Events\TelerivetSmsSent;
use CoreProc\NotificationChannels\Telerivet\Exceptions\CouldNotSendNotification;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Notifications\Notification;
use Psr\Http\Message\ResponseInterface;

class TelerivetChannel
{
    public const DEFAULT_API_URL = 'https://api.telerivet.com';

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     *
     * @return ResponseInterface
     * @throws CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var TelerivetMessage $telerivetMessage */
        $telerivetMessage = $notification->toTelerivet($notifiable);

        // If the message does not have a to_number of contact_id
        if (empty($telerivetMessage->getToNumber()) && empty($telerivetMessage->getContactId())) {
            // Check first if the notifiable object has a telerivetContactId
            if (! empty($notifiable->routeNotificationFor('telerivetContactId'))) {
                $telerivetMessage->setContactId($notifiable->routeNotificationFor('telerivetContactId'));
            } else {
                // If not, default to the "telerivet" route which should be a phone number
                $telerivetMessage->setToNumber($notifiable->routeNotificationFor('telerivet'));
            }
        }

        event(new TelerivetSmsSending($notifiable, $telerivetMessage));

        try {
            /** @var Response $response */
            $response = $this->client->post(
                'v1/projects/' . $this->getProjectId($telerivetMessage) . '/messages/send',
                [
                    'auth' => [$this->getApiKey($telerivetMessage), ''],
                    'json' => $telerivetMessage->toArray(),
                ]
            );
        } catch (RequestException $requestException) {
            event(new TelerivetSmsFailed($notifiable, $telerivetMessage, $requestException));

            throw CouldNotSendNotification::serviceRespondedWithAnError($requestException);
        }

        event(new TelerivetSmsSent($notifiable, $telerivetMessage, $response));

        return $response;
    }

    protected function getProjectId(TelerivetMessage $telerivetMessage)
    {
        if (! empty($telerivetMessage->getProjectId())) {
            return $telerivetMessage->getProjectId();
        }

        return config('telerivet.project_id');
    }

    protected function getApiKey(TelerivetMessage $telerivetMessage)
    {
        if (! empty($telerivetMessage->getApiKey())) {
            return $telerivetMessage->getApiKey();
        }

        return config('telerivet.api_key');
    }
}
