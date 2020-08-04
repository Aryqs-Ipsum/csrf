# Simple CSRF token protection

This repository contain two simplified methods to store and verify tokens. It prevent all unsafe HTTP requests.

POST and SESSION variables are stored in '_token' values. This string can be changed in param of function

## Install

via composer

```
$ composer require aryqs/csrf
```

## Usage

```php
use aryqs\csrf\Token;

require __DIR__ . '/vendor/autoload.php';

# verify token
if(isset($_POST['_token']) && Token::verify()) {
    # ...
}
```

```html
<!-- in form, dont forget to import class -->
<form method="post">
    <?= Token::set() ?>
</form>
```

You can change the name of the key that store data in session and post by passing it in param of the function

```php
Token::set('csrf');
Token::verify('csrf');
```

## Licence

This code is licenced under MIT licence