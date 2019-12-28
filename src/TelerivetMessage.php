<?php

namespace CoreProc\NotificationChannels\Telerivet;

class TelerivetMessage
{
    /**
     * @var string
     */
    protected $messageType;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $toNumber;

    /**
     * @var string
     */
    protected $contactId;

    /**
     * @var string
     */
    protected $routeId;

    /**
     * @var string
     */
    protected $statusUrl;

    /**
     * @var string
     */
    protected $statusSecret;

    /**
     * @var bool
     */
    protected $isTemplate;

    /**
     * @var bool
     */
    protected $trackClicks;

    /**
     * @var array
     */
    protected $mediaUrls;

    /**
     * @var array
     */
    protected $labelIds;

    /**
     * @var object
     */
    protected $vars;

    /**
     * @var int
     */
    protected $priority;

    /**
     * @var bool
     */
    protected $simulated;

    /**
     * @var string
     */
    protected $serviceId;

    /**
     * @var string
     */
    protected $audioUrl;

    /**
     * @var string
     */
    protected $ttsLang;

    /**
     * @var string
     */
    protected $ttsVoice;

    /**
     * @return string
     */
    public function getMessageType(): ?string
    {
        return $this->messageType;
    }

    /**
     * [Optional] Type of message to send. If text, will use the default text message type for the selected route.
     * Possible Values: sms, mms, ussd, call, text
     * Default: text
     *
     * @param string $messageType
     * @return TelerivetMessage
     */
    public function setMessageType(?string $messageType): self
    {
        $this->messageType = $messageType;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * [Required if sending SMS message]
     * Content of the message to send (if message_type is call, the text will be spoken during a text-to-speech call)
     *
     * @param string $content
     * @return TelerivetMessage
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getToNumber(): ?string
    {
        return $this->toNumber;
    }

    /**
     * [Required if contact_id not set]
     * Phone number to send the message to.
     *
     * @param string $toNumber
     * @return TelerivetMessage
     */
    public function setToNumber(?string $toNumber): self
    {
        $this->toNumber = $toNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactId(): ?string
    {
        return $this->contactId;
    }

    /**
     * [Required if to_number not set]
     * ID of the contact to send the message to
     *
     * @param string $contactId
     * @return TelerivetMessage
     */
    public function setContactId(?string $contactId): self
    {
        $this->contactId = $contactId;

        return $this;
    }

    /**
     * @return string
     */
    public function getRouteId(): ?string
    {
        return $this->routeId;
    }

    /**
     * [Optional] ID of the phone or route to send the message from
     * Default: default sender route ID for your project
     *
     * @param string $routeId
     * @return TelerivetMessage
     */
    public function setRouteId(?string $routeId): self
    {
        $this->routeId = $routeId;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatusUrl(): ?string
    {
        return $this->statusUrl;
    }

    /**
     * [Optional] Webhook callback URL to be notified when message status changes
     *
     * @param string $statusUrl
     * @return TelerivetMessage
     */
    public function setStatusUrl(?string $statusUrl): self
    {
        $this->statusUrl = $statusUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatusSecret(): ?string
    {
        return $this->statusSecret;
    }

    /**
     * [Optional] POST parameter 'secret' passed to status_url
     *
     * @param string $statusSecret
     * @return TelerivetMessage
     */
    public function setStatusSecret(?string $statusSecret): self
    {
        $this->statusSecret = $statusSecret;

        return $this;
    }

    /**
     * @return bool
     */
    public function isTemplate(): ?bool
    {
        return $this->isTemplate;
    }

    /**
     * [Optional] Set to true to evaluate variables like [[contact.name]] in message content.
     * (See available variables https://telerivet.com/api/rest/curl#variables)
     * Default: false
     *
     * @param bool $isTemplate
     * @return TelerivetMessage
     */
    public function setIsTemplate(?bool $isTemplate): self
    {
        $this->isTemplate = $isTemplate;

        return $this;
    }

    /**
     * @return bool
     */
    public function isTrackClicks(): ?bool
    {
        return $this->trackClicks;
    }

    /**
     * [Optional] If true, URLs in the message content will automatically be replaced with unique short URLs.
     * Default: false
     *
     * @param bool $trackClicks
     * @return TelerivetMessage
     */
    public function setTrackClicks(?bool $trackClicks): self
    {
        $this->trackClicks = $trackClicks;

        return $this;
    }

    /**
     * @return array
     */
    public function getMediaUrls(): ?array
    {
        return $this->mediaUrls;
    }

    /**
     * [Optional] URLs of media files to attach to the text message. If message_type is sms, short links to each media
     * URL will be appended to the end of the content (separated by a new line).
     *
     * @param array $mediaUrls
     * @return TelerivetMessage
     */
    public function setMediaUrls(?array $mediaUrls): self
    {
        $this->mediaUrls = $mediaUrls;

        return $this;
    }

    /**
     * @return array
     */
    public function getLabelIds(): ?array
    {
        return $this->labelIds;
    }

    /**
     * [Optional] Array string IDs of Label <https://telerivet.com/api/rest/curl#Label>
     * List of IDs of labels to add to this message
     *
     * @param array $labelIds
     * @return TelerivetMessage
     */
    public function setLabelIds(?array $labelIds): self
    {
        $this->labelIds = $labelIds;

        return $this;
    }

    /**
     * @return object
     */
    public function getVars(): ?object
    {
        return $this->vars;
    }

    /**
     * [Optional] Custom variables to store with the message
     *
     * @param object $vars
     * @return TelerivetMessage
     */
    public function setVars(?object $vars): self
    {
        $this->vars = $vars;

        return $this;
    }

    /**
     * @return int
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * [Optional] Priority of the message. Telerivet will attempt to send messages with higher priority numbers first
     * (for example, so you can prioritize an auto-reply ahead of a bulk message to a large group).
     * Possible Values: 1, 2
     * Default: 1
     *
     * @param int $priority
     * @return TelerivetMessage
     */
    public function setPriority(?int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSimulated(): ?bool
    {
        return $this->simulated;
    }

    /**
     * [Optional] Set to true to test the Telerivet API without actually sending a message from the route
     * Default: false
     *
     * @param bool $simulated
     * @return TelerivetMessage
     */
    public function setSimulated(?bool $simulated): self
    {
        $this->simulated = $simulated;

        return $this;
    }

    /**
     * @return string
     */
    public function getServiceId(): ?string
    {
        return $this->serviceId;
    }

    /**
     * [Optional] string ID of Service <https://telerivet.com/api/rest/curl#Service>
     * Service that defines the call flow of the voice call (when message_type is call)
     *
     * @param string $serviceId
     * @return TelerivetMessage
     */
    public function setServiceId(?string $serviceId): self
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    /**
     * @return string
     */
    public function getAudioUrl(): ?string
    {
        return $this->audioUrl;
    }

    /**
     * [Optional] The URL of an MP3 file to play when the contact answers the call (when message_type is call).
     * If audio_url is provided, the text-to-speech voice is not used to say content, although you can optionally use
     * content to indicate the script for the audio.
     * For best results, use an MP3 file containing only speech. Music is not recommended because the audio quality will
     * be low when played over a phone line.
     *
     * @param string $audioUrl
     * @return TelerivetMessage
     */
    public function setAudioUrl(?string $audioUrl): self
    {
        $this->audioUrl = $audioUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getTtsLang(): ?string
    {
        return $this->ttsLang;
    }

    /**
     * [Optional] The language of the text-to-speech voice (when message_type is call)
     * Possible Values: en-US, en-GB, en-GB-WLS, en-AU, en-IN, da-DK, nl-NL, fr-FR, fr-CA, de-DE, is-IS, it-IT, pl-PL,
     * pt-BR, pt-PT, ru-RU, es-ES, es-US, sv-SE
     * Default: en-US
     *
     * @param string $ttsLang
     * @return TelerivetMessage
     */
    public function setTtsLang(?string $ttsLang): self
    {
        $this->ttsLang = $ttsLang;

        return $this;
    }

    /**
     * @return string
     */
    public function getTtsVoice(): ?string
    {
        return $this->ttsVoice;
    }

    /**
     * [Optional] The name of the text-to-speech voice (when message_type=call)
     * Possible Values: female, male
     * Default: female
     *
     * @param string $ttsVoice
     * @return TelerivetMessage
     */
    public function setTtsVoice(?string $ttsVoice): self
    {
        $this->ttsVoice = $ttsVoice;

        return $this;
    }

    public function toArray()
    {
        return [
            'message_type' => $this->getMessageType(),
            'content' => $this->getContent(),
            'to_number' => $this->getToNumber(),
            'contact_id' => $this->getContactId(),
            'route_id' => $this->getRouteId(),
            'status_url' => $this->getStatusUrl(),
            'status_secret' => $this->getStatusSecret(),
            'is_template' => $this->isTemplate(),
            'track_clicks' => $this->isTrackClicks(),
            'media_urls' => $this->getMediaUrls(),
            'label_ids' => $this->getLabelIds(),
            'vars' => $this->getVars(),
            'priority' => $this->getPriority(),
            'simulated' => $this->isSimulated(),
            'service_id' => $this->getServiceId(),
            'audio_url' => $this->getAudioUrl(),
            'tts_lang' => $this->getTtsLang(),
            'tts_voice' => $this->getTtsVoice(),
        ];
    }
}
