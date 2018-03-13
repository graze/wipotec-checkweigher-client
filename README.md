# wipotec-checkweigher-client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/graze/wipotec-checkweigher-client.svg?style=flat-square)](https://packagist.org/packages/graze/wipotec-checkweigher-client)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/graze/wipotec-checkweigher-client/master.svg?style=flat-square)](https://travis-ci.org/graze/wipotec-checkweigher-client)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/graze/wipotec-checkweigher-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/graze/wipotec-checkweigher-client/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/graze/wipotec-checkweigher-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/graze/wipotec-checkweigher-client)
[![Total Downloads](https://img.shields.io/packagist/dt/graze/wipotec-checkweigher-client.svg?style=flat-square)](https://packagist.org/packages/graze/wipotec-checkweigher-client)

Wipotec checkweigher client written in PHP. 

## Install

Via Composer

``` bash
$ composer require graze/wipotec-checkweigher-client
```

## Usage

### Instantiating a client

Use the `factory` method to return a `Client` instance:

```php
$client = \Graze\WipotecCheckweigherClient\Client::factory();
...
```

### Sending requests

Connect to the remote checkweigher using the `connect` method:

```php
...
$dsn = '127.0.0.1:55001';
$client->connect($dsn);
...
```

Once connected, the `sendRequest` method can be used to send requests to the checkweigher:

```php
...
$request = new \Graze\WipotecCheckweigherClient\Request\RequestSetArticle();
$request->setArticleParam(Parameter::NAME, $articleName);
$request->setArticleParam(Parameter::NUMBER, $articleNumber);
$response = $client->sendRequest($request);
...
```

### Responses

If a corresponding response class exists (in `\Graze\Wipotec\Response\`) for a request then it will be used, otherwise the `ResponseGeneric` will be returned.

All responses have the following methods: 

```php
/**
 * Whether an error was returned.
 *
 * @return bool
 */
public function hasError();

/**
 * Get the error message. 
 *
 * @return string
 */
public function getError();

/**
 * Get the raw response as an array. 
 *
 * @return mixed[]
 */
public function getContents();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

```shell
make build test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email security@graze.com instead of using the issue tracker.

## Credits

- [Brendan Kay](https://github.com/brendankay)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
