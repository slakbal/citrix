*WORK IN PROGRESS*

#LARAVEL CITRIX GOTOWEBINAR API Wrapper package
------------

This package currently make use of DIRECT AUTHENTICATION. OAuth2 authentication will be build in at a later stage.

##Setup:

* run composer require slakbal/citrix or update composer.json to include 'slakbal/citrix' : '*'

* Add the following config keys and their values to your .env file

CITRIX_DIRECT_USER=test@test.com
CITRIX_DIRECT_PASSWORD=testpassword
CITRIX_CONSUMER_KEY=123123123123

* In config/app.php add service provider

Slakbal\Citrix\CitrixServiceProvider::class,

* In the same file also add the faced in the facade section

'GotoWebinar'      => Slakbal\Citrix\Facade\GotoWebinar::class,

* run composer dump-autoload

##Usage:

list all the methods