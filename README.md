# Ionic Platform API SDK

So a bit of an explanation. There is an API to the services that the Ionic Platform provides and this is a simple PHP wrapper that you can use.

For reference - [http://docs.ionic.io/docs/api-getting-started](API docs on the Ionic.io site).

Still work-in-progress.

## Installation

Using [Composer](http://getcomposer.org):

```
composer require mirovit/ionic-platform-sdk
```

## Contribution

Contributions are welcome, the only thing that is important for me is the expressive syntax and at some point when I've written tests - tests.

## Usage

This package uses a fluent syntax, so it is very easy to read and understand the underlying code.

## What you can use

Currently only the `users` endpoint is ready. The other will be coming soon : )

```php
<?php

require __DIR__ . '/vendor/autoload.php';

// By default, if a token is not passed in the constructor,
// the class will try to load the token from
// IONIC_TOKEN environment variable. The second param,
// the API endpoint is set as default value to
// https://api.ionic.io/, which is the current endpoint:
$sdk = new Mirovit\IonicPlatformSDK\IonicPlatformSDK();
// or explicitly them:
$sdk = new Mirovit\IonicPlatformSDK\IonicPlatformSDK(
    'ionic_api_token',
    'api_endpoint'
);

// Retrieve an user
$user = $sdk
            ->users()
            ->get('user-uuid-from-ionic');

// Create an user
$newUser = $sdk
            ->users()
            ->create([
                'app_id'    => 'your_app_id',
                'email'     => 'john@doe.com',
                'password'  => 'very_secret_passw0rd',
            ]);

```

## Available endpoints

### users()

```php
<?php
// http://docs.ionic.io/docs/api-users#users-list
$sdk
    ->users()
    ->all();

// http://docs.ionic.io/docs/api-users#users-get
$sdk
    ->users()
    ->get('user-uuid');

// http://docs.ionic.io/docs/api-users#users-self
$sdk
    ->users()
    ->self();

// http://docs.ionic.io/docs/api-users#users-post
$sdk
    ->users()
    ->create([
        // required
        'app_id'    => '',
        'email'     => '',
        'password'  => '',
        // optional
        'name'      => '',
        'username'  => '',
        'image'     => '',
        'custom'    => [
            'foo'   => 'bar',
            'what'  => 'ever',
        ],
    ]);

// http://docs.ionic.io/docs/api-users#users-patch
$sdk
    ->users()
    ->update([
        // required
        'uuid'      => '',
        'email'     => '',
        'password'  => '',
        // optional
        'name'      => '',
        'username'  => '',
        'image'     => '',
        'custom'    => [
            'foo'   => 'bar',
            'what'  => 'ever',
        ],
    ]);

// http://docs.ionic.io/docs/api-users#users-delete
$sdk
    ->users()
    ->destroy('user-uuid');

// http://docs.ionic.io/docs/api-users#users-custom-get
$sdk
    ->users()
    ->getCustom('user-uuid');

// http://docs.ionic.io/docs/api-users#users-custom-put
$sdk
    ->users()
    ->setCustom([
        // required
        'uuid'  => 'user-uuid',
        // optional, whatever data you need to store
        'foo'   => 'baz',
        'bar'   => 'foo',
    ]);

// http://docs.ionic.io/docs/api-users#users-password-reset
$sdk
    ->users()
    ->passwordReset();
```

### push()

```php
<?php
// http://docs.ionic.io/docs/api-push#notifications-list
$sdk
    ->push()
    ->notifications()
    ->all();

// http://docs.ionic.io/docs/api-push#notifications-get
$sdk
    ->push()
    ->notifications()
    ->get('notification-uuid');

// http://docs.ionic.io/docs/api-push#notifications-list-messages
$sdk
    ->push()
    ->notifications()
    ->messages('notification-uuid');

// http://docs.ionic.io/docs/api-push#notifications-post
$sdk
    ->push()
    ->notifications()
    ->create([

    ]);

// http://docs.ionic.io/docs/api-push#messages-list
$sdk
    ->push()
    ->messages()
    ->all();

// http://docs.ionic.io/docs/api-push#messages-get
$sdk
    ->push()
    ->messages()
    ->get('message-uuid');

// http://docs.ionic.io/docs/api-push#tokens-list
$sdk
    ->push()
    ->tokens()
    ->all();

// http://docs.ionic.io/docs/api-push#tokens-get
$sdk
    ->push()
    ->tokens();

// http://docs.ionic.io/docs/api-push#tokens-patch
$sdk
    ->push()
    ->tokens()
    ->validate('token-uuid');

$sdk
    ->push()
    ->tokens()
    ->invalidate('token-uuid');

$sdk
    ->push()
    ->tokens()
    ->changeStatus('token-uuid', 'status');

// http://docs.ionic.io/docs/api-push#tokens-post
$sdk
    ->push()
    ->tokens()
    ->save('token-string', 'user-uuid');

// http://docs.ionic.io/docs/api-push#tokens-delete
$sdk
    ->push()
    ->tokens()
    ->destroy('token-uuid');

```

### deploy()

```php
<?php
// http://docs.ionic.io/docs/api-deploy#channels-list
$sdk
    ->deploy()
    ->channels()
    ->all();

// http://docs.ionic.io/docs/api-deploy#channels-get
$sdk
    ->deploy()
    ->channels()
    ->get('channel-uuid');

// http://docs.ionic.io/docs/api-deploy#channels-get-tag
$sdk
    ->deploy()
    ->channels()
    ->tag('tag');

// http://docs.ionic.io/docs/api-deploy#channels-post
$sdk
    ->deploy()
    ->channels()
    ->create([

    ]);

// http://docs.ionic.io/docs/api-deploy#channels-edit
$sdk
    ->deploy()
    ->channels()
    ->update([

    ]);

// http://docs.ionic.io/docs/api-deploy#channels-delete
$sdk
    ->deploy()
    ->channels()
    ->destroy('channel-uuid');

// http://docs.ionic.io/docs/api-deploy#snapshots-list
$sdk
    ->deploy()
    ->snapshots()
    ->all();

// http://docs.ionic.io/docs/api-deploy#snapshots-get
$sdk
    ->deploy()
    ->snapshots()
    ->get('snapshot-uuid');

// http://docs.ionic.io/docs/api-deploy#snapshots-edit
$sdk
    ->deploy()
    ->snapshots()
    ->update([

    ]);

// http://docs.ionic.io/docs/api-deploy#deploys-list
$sdk
    ->deploy()
    ->deploys()
    ->all();

// http://docs.ionic.io/docs/api-deploy#deploys-post
$sdk
    ->deploy()
    ->deploys()
    ->set('channel-uuid', 'snapshot-uuid');

// http://docs.ionic.io/docs/api-deploy#deploys-delete
$sdk
    ->deploy()
    ->deploys()
    ->destroy('deploy-uuid');
```

