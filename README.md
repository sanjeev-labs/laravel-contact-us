# laravel-contact-us
Contact us form for laravel applications. Receive emails from contact us form with spam protection through Google reCaptcha V2. 


## Installation via composer
- Run below command

```
composer require sanjeev-labs/laravel-contact-us
```
- Add provider Sanjeevlabs\Contact\ContactServiceProvider::class in your providers list in config/app.php

- Run below command, scaffold the controller and views.

```
php artisan make:contact
```
- Run below command to publish configuration contact.php in your config directory.

```
php artisan vendor:publish --tag=config
```
## Configuration Changes

- In config/contact.php replace SITE_KEY with your site key of Google reCaptcha. And replace SECRET_KEY with your secret key of Google reCaptcha. If you don't have site and secret keys, you can get from [here](https://www.google.com/recaptcha/admin).
- In config/contact.php replace 'Owner' with your desired name.
- In config/contact.php replace 'owner@example.com' with your email address where you want to receive emails.

## View Changes

- To change the layout design or to add more fields, make changes in resources/views/contact/contact.blade.php and/or resources/views/contact/layout.blade.php files.

## Email Changes
- To change in the email designs or to add more fields, make changes in resources/views/emails/contact/contact.blade.php and/or resources/views/emails/contact/contact-confirm.blade.php files.

