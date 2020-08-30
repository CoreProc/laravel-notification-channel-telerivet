# Laravel Telerivet Notification Channel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/coreproc/laravel-notification-channel-telerivet.svg?style=flat-square)](https://packagist.org/packages/coreproc/laravel-notification-channel-telerivet)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![StyleCI](https://styleci.io/repos/230629587/shield)](https://styleci.io/repos/230629587)
[![Quality Score](https://img.shields.io/scrutinizer/g/coreproc/laravel-notification-channel-telerivet.svg?style=flat-square)](https://scrutinizer-ci.com/g/coreproc/laravel-notification-channel-telerivet)
[![Total Downloads](https://img.shields.io/packagist/dt/coreproc/laravel-notification-channel-telerivet.svg?style=flat-square)](https://packagist.org/packages/coreproc/laravel-notification-channel-telerivet)

This package makes it easy to send notifications using [Telerivet](https://telerivet.com/) with Laravel 5.5+ and 6.0

## Contents

- [Installation](#installation)
	- [Setting up the Telerivet service](#setting-up-the-Telerivet-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Upgrading from v1.x to v2.x

In v2.x, we've moved the configuration settings of Telerivet from `config/broadcasting.php` to `config/telerivet.php`.

To migrate to v2.x, simply run the following command to get the configuration file:

```
php artisan vendor:publish --provider="CoreProc\NotificationChannels\Telerivet\TelerivetServiceProvider"
```

## Installation

Install this package with Composer:

    composer require coreproc/laravel-notification-channel-telerivet
    
Register the ServiceProvider in your config/app.php (Skip this step if you are using Laravel 5.5):

    CoreProc\NotificationChannels\Telerivet\TelerivetServiceProvider::class,

### Setting up the Telerivet service

You need to register for an API key and a number for outgoing SMS here: 
[https://telerivet.com](https://telerivet.com)

Once you've registered and set up your project and numbers, get the configuration file by running the following command:

```
php artisan vendor:publish --provider="CoreProc\NotificationChannels\Telerivet\TelerivetServiceProvider"
```

Add the API key and project ID to your configuration in `config/telerivet.php`. You can set the credentials in your
`.env` file with the following variables: `TELERIVET_API_KEY` and `TELERIVET_PROJECT_ID`.

Optionally, you can also override these configurations by calling the `setApiKey()` and `setProjectId()` methods
in your `TelerivetMessage` object.

## Usage

You can now send SMS via Telerivet by creating a `TelerivetMessage`:

```php
use CoreProc\NotificationChannels\Telerivet\TelerivetChannel;
use CoreProc\NotificationChannels\Telerivet\TelerivetMessage;
use Illuminate\Notifications\Notification;

class AccountActivated extends Notification
{
    public function via($notifiable)
    {
        return [TelerivetChannel::class];
    }

    public function toTelerivet($notifiable)
    {
        return (new TelerivetMessage())
            ->setContent('Hello this is a test message');
    }
}
```

You will have to set a `routeNotificationForTelerivet()` method in your notifiable model. For example:

```php
class User extends Authenticatable
{
    use Notifiable;

    ....

    /**
     * Specifies the user's mobile number for use in Telerivet
     *
     * @return string
     */
    public function routeNotificationForTelerivet()
    {
        return $this->mobile_number;
    }
}
```

Once you have that in place, you can simply send an SMS notification to the user via

```
$user->notify(new AccountActivated);
```

### Events

You can listen to these event when sending a Telerivet SMS message:

Before an SMS is sent:

`TelerivetSmsSending::class`

When an SMS is sent (this means that the API call to Telerivet was successful):

`TelerivetSmsSent::class`

When an SMS fails to send (this means the API call to Telerivet has failed):

`TelerivetSmsFailed::class` 

### Available Message methods

All the parameters that can be used for a Telerivet message can be applied through the `TelerivetMessage` object. The
documentation from Telerivet can be found here [here](https://telerivet.com/api/rest/curl#Project.sendMessage).


```php
setMessageType(?string $messageType)
```

[Optional] Type of message to send. If text, will use the default text message type for the selected route.

Possible Values: sms, mms, ussd, call, text

Default: text

```php
setContent(?string $content)
```

[Required if sending SMS message] Content of the message to send (if message_type is call, the text will be spoken during a text-to-speech call)

```php
setToNumber(?string $toNumber)
```

[Required if contact_id not set] Phone number to send the message to. This is automatically set if you have defined the
`routeNotificationForTelerivet()` method in your notifiable object.

```php
setContactId(?string $contactId)
```

[Required if to_number not set] ID of the contact to send the message to. This can be automatically set if you have
defined a `routeNotificationForTelerivetContactId()` method in your notifiable object.

```php
setRouteId(?string $routeId)
```

[Optional] ID of the phone or route to send the message from

Default: default sender route ID for your project

```php
setStatusUrl(?string $statusUrl)
```

[Optional] Webhook callback URL to be notified when message status changes

```php
setStatusSecret(?string $statusSecret)
```

[Optional] POST parameter 'secret' passed to status_url

```php
setIsTemplate(?bool $isTemplate)
```

[Optional] Set to true to evaluate variables like [[contact.name]] in message content.

(See available variables [here](https://telerivet.com/api/rest/curl#variables))

Default: false

```php
setTrackClicks(?bool $trackClicks)
```

[Optional] If true, URLs in the message content will automatically be replaced with unique short URLs.

Default: false

```php
setMediaUrls(?array $mediaUrls)
```

[Optional] URLs of media files to attach to the text message. If message_type is sms, short links to each media

URL will be appended to the end of the content (separated by a new line).

```php
setLabelIds(?array $labelIds)
```

[Optional] Array string IDs of [Label](https://telerivet.com/api/rest/curl#Label)

List of IDs of labels to add to this message

```php
setVars(?object $vars)
```

[Optional] Custom variables to store with the message

```php
setPriority(?int $priority)
```

[Optional] Priority of the message. Telerivet will attempt to send messages with higher priority numbers first 
(for example, so you can prioritize an auto-reply ahead of a bulk message to a large group).

Possible Values: 1, 2

Default: 1

```php
setSimulated(?bool $simulated)
```

[Optional] Set to true to test the Telerivet API without actually sending a message from the route

Default: false

```php
setServiceId(?string $serviceId)
```

[Optional] string ID of [Service](https://telerivet.com/api/rest/curl#Service)

Service that defines the call flow of the voice call (when message_type is call)

```php
setAudioUrl(?string $audioUrl)
```

[Optional] The URL of an MP3 file to play when the contact answers the call (when message_type is call).

If audio_url is provided, the text-to-speech voice is not used to say content, although you can optionally use
content to indicate the script for the audio.

For best results, use an MP3 file containing only speech. Music is not recommended because the audio quality will
be low when played over a phone line.

```php
setTtsLang(?string $ttsLang)
```

[Optional] The language of the text-to-speech voice (when message_type is call)

Possible Values: en-US, en-GB, en-GB-WLS, en-AU, en-IN, da-DK, nl-NL, fr-FR, fr-CA, de-DE, is-IS, it-IT, pl-PL,
pt-BR, pt-PT, ru-RU, es-ES, es-US, sv-SE

Default: en-US

```php
setTtsVoice(?string $ttsVoice)
```

[Optional] The name of the text-to-speech voice (when message_type=call)

Possible Values: female, male

Default: female

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security related issues, please email to chris.bautista@coreproc.ph instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Chris Bautista](https://github.com/chrisbjr)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
