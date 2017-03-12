## Newsletter module to integrate mailchimp with laravel ##

what you can do?

subscribe new users.
unsubscribe users.
get list.
update status of subscribers.
delete a subscribers.


##Installation steps

composer require groovel/newsletter-mailchimp

You have to add in your laravel install in /config/app.php
the provider :
Groovel\MailChimp\MailChimpServiceProvider::class,

and alias :
'MailChimp'=>Groovel\MailChimp\Facades\MailChimp::class

Then create your account on mailchimp and generate an api token.

Configure the config/MailChimpConfig

token_user => your api token

base_uri => https://<dc>.api.mailchimp.com

the dc is the last part of your token api ex token : xxx-[dc]

version=>3.0 for the version 3.0 of mailchimp

Exemple : let's see MailChimpTest.php
set variables private $listId='list-id';
			  private $fakeemail="fake-email"

Do not hesitate to reply me!

thanks