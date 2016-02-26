# Citrix GotoWebinar API Provider for Laravel

This package is a Citrix GotoWebinar API service provider and facade for Laravel 5.1+. It was inspired by [Teodor Talov's Citrix API wrapper package](https://github.com/teodortalov/citrix).


## Installing

You can use Composer to install the library

```
composer require slakbal/citrix
```

Find the `providers` array in the `config/app.php` file and add the following Service Provider:

```php
'providers' => [
  // ...
  Slakbal\Citrix\CitrixServiceProvider::class
];
```

Now find the `aliases` array in the same config file and add the following Facade class:

```php
'aliases' => [
  // ...
  'GotoWebinar' => Slakbal\Citrix\Facade\GotoWebinar::class
];
```



## Config

Before you can use the Citrix service provider you have configure it. You can create API access keys here: [CITRIX Developer portal](https://developer.citrixonline.com/user/me/apps).

Note that you need to have an active or trial account for the API to function properly. Just dev credentials alone will not work.

The provider currently only support `Direct` authentication. An OAuth2 authentication will be added later also.

The following environment values are required in your `.env` file. The provider doesn't publish any config, etc. thus your project stays clean.

```
CITRIX_DIRECT_USER=test@test.com
CITRIX_DIRECT_PASSWORD=testpassword
CITRIX_CONSUMER_KEY=123123123123
```



## Usage

### Webinar Resource

```php

// Return list of all the Webinars
$webinars = GotoWebinar::getAllWebinars();


// Return the list of all upcoming Webinars
$webinars = GotoWebinar::getUpcomingWebinars();


// Return list of historical Webinars - date format standard: W3C - ISO 8601
$dateRange = [  'fromTime' => "2016-01-01T01:00:00Z",
                'toTime'   => "2016-03-23T20:00:00Z", ];

$webinars = GotoWebinar::getHistoricalWebinars( $dateRange );


// Return a specific Webinar
$webinar = GotoWebinar::getWebinar( $webinarKey );


// Create a Webinar - date format standard: W3C - ISO 8601
$webinar = [ 'subject'     => 'API Test 2',
             'description' => 'This Webinar is created via the API',
             'startTime'   => "2016-03-23T19:00:00Z",
             'endTime'     => "2016-03-23T20:00:00Z", ];

$webinar = GotoWebinar::createWebinar( $webinar );
```

### Attendee and Registrant Resource

```php
// Return a list of attendees for a specific Webinar
$attendees = GotoWebinar::getWebinarAttendees( $webinarKey );


// Register an attendee for a specific Webinar
$webinarKey = '7102152795910768396';

$registrant = [ 'firstname'    => 'Peter',
                'lastname'     => 'Pan',
                'email'        => 'peter.pan@gmail.com',
                'organization' => 'Neverland', ];

$result = GotoWebinar::registerAttendee( $webinarKey, $registrant );


// Return a list of registrants for a specific Webinar
$registrants = GotoWebinar::getWebinarRegistrants( $webinarKey );


// Return a specific registrant from a specific Webinar
$registrant = GotoWebinar::getWebinarRegistrant( $webinarKey, $registrantKey );


// Remove a specific registrant from a specific Webinar
$result = GotoWebinar::deleteWebinarRegistrant( $webinarKey, $registrantKey );
```

### Session Resource

```php
// Return list of sessions for the Organizer ()
$sessions = GotoWebinar::getOrganizerSessions();


// Return list of attendees for a specific Webinar and specific session
$attendees = GotoWebinar::getWebinarSessionAttendees( $webinarKey, $sessionKey );


// Return a specific attendee for a specific Webinar and specific session
$attendee = GotoWebinar::getWebinarSessionAttendee( $webinarKey, $sessionKey, $registrantKey );
```

Your contribution or bug fixes are welcome!

Next steps will be to build out more robuster error handling, add OAuth2 Authentication and adding the GotoMeeting provider into the package also.

Enjoy!
