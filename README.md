# support

[![Latest Stable Version](http://poser.pugx.org/tinywan/support/v)](https://packagist.org/packages/tinywan/support)
[![Total Downloads](http://poser.pugx.org/tinywan/support/downloads)](https://packagist.org/packages/tinywan/support)
[![License](http://poser.pugx.org/tinywan/support/license)](https://packagist.org/packages/tinywan/support)

handle with array/log/config/guzzle/function

## Logger

```php
use Tinywan\Support\Logger;
$logger = new Logger();
$logger->setConfig(['file' => runtime_path().'/tinywan.log']);
$logger->info('test info', ['foo' => 'bar']);
```

# Other

composer
```
composer dumpautoload
```

phpstan
```php
vendor/bin/phpstan analyse src
```

php-cs-fixer
```php
vendor/bin/php-cs-fixer fix src
```

vimeo/psalm
```php
./vendor/bin/psalm --show-info=true
```
> https://github.com/vimeo/psalm