# versioned-assets
# Fast and powerful php versioned-assets engine

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/teodoroleckie/versioned-assets/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/teodoroleckie/versioned-assets/?branch=main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/teodoroleckie/versioned-assets/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)
[![Build Status](https://scrutinizer-ci.com/g/teodoroleckie/versioned-assets/badges/build.png?b=main)](https://scrutinizer-ci.com/g/teodoroleckie/versioned-assets/build-status/main)

## Installation

You can install the package via composer:

```bash
composer require tleckie/versioned-assets
```
Moving asset locations is cumbersome and error, prone - it requires you to carefully update the URLs of all assets included in all templates.
The asset component allows you to have full control of the paths of your resources in an orderly way that is easy to maintain.

# Usage

```php
<?php

use Tleckie\Assets\Bucket;
use Tleckie\Assets\Versioned\Versioned;

$bucket =   new Bucket(new Versioned('v1'), '/path');

// Relative path
$bucket->url('js/app.js');
//result: /path/js/app.js?v1

// Absolute path
$bucket->url('/js/app.js');
//result: /js/app.js?v1
```

You can also customize the format of your version by adding the second parameter to which a sprintf will be applied:
```php
<?php

use Tleckie\Assets\Bucket;
use Tleckie\Assets\Versioned\Versioned;

$bucket =   new Bucket(
    new Versioned('v1', "%s?custom-version=%s"), 
    '/path'
);

// Relative path
$bucket->url('js/app.js');
//result: /path/js/app.js?custom-version=v1

// Absolute path
$bucket->url('/js/app.js');
//result: /js/app.js?custom-version=v1
```

If you need to include your assets to have a domain, you simply need to include the domain as the value of the path argument:
When configuring a domain as a path, the resources included as relative and absolute will have the same result
```php
<?php

use Tleckie\Assets\Bucket;
use Tleckie\Assets\Versioned\Versioned;

$bucket =   new Bucket(
    new Versioned('v1', '%s?version=%s'), 
    '//domain.cookieless.com'
);

// Relative path
$bucket->url('js/app.js');
//result: //domain.cookieless.com/js/app.js?version=v1

// Absolute path
$bucket->url('/js/app.js');
//result: //domain.cookieless.com/js/app.js?version=v1
```

You can also use NullVersioned if you want to disable versioning for your assets.
```php
<?php

use Tleckie\Assets\Bucket;
use Tleckie\Assets\Versioned\NullVersioned;

$bucket =   new Bucket(
    new NullVersioned(), 
    '//domain.cookieless.com'
);

// Relative path
$bucket->url('js/app.js');
//result: //domain.cookieless.com/js/app.js
```

A popular strategy to manage asset versioning, which is used by tools such as Webpack, is to generate a JSON file mapping all source file names to their corresponding output file:
```json
{
"css/app.css": "build/css/app.af316426ea1d10021f3f17ce8031f93c2.css",
"js/app.js": "build/js/app.56fa630905267b809161e71d0f8a0c017b.js"
}
```

```php
<?php

use Tleckie\Assets\Bucket;
use Tleckie\Assets\Versioned\JsonManifestVersioned;
$bucket =   new Bucket(
    new JsonManifestVersioned('./json/rev-manifest.json')
);

$bucket->url('css/app.css');
//result: build/css/app.af316426ea1d10021f3f17ce8031f93c2.css

$bucket->url('js/app.js');
//result: build/js/app.56fa630905267b809161e71d0f8a0c017b.js
```

```php
<?php

use Tleckie\Assets\Bucket;
use Tleckie\Assets\Versioned\JsonManifestVersioned;

$bucket =   new Bucket(
    new JsonManifestVersioned('./json/rev-manifest.json'),
    '//domain.cookieless.com'
);

$bucket->url('css/app.css');
//result: //domain.cookieless.com/build/css/app.af316426ea1d10021f3f17ce8031f93c2.css

$bucket->url('js/app.js');
//result: //domain.cookieless.com/build/js/app.56fa630905267b809161e71d0f8a0c017b.js
```

That's all! I hope this helps you ;)