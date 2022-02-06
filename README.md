# Bscscan PHP API

PHP wrapper for the Bscscan API

[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

[Official API Documentation](https://docs.bscscan.com)

[Create API Key (optional)](https://bscscan.com/myapikey)

## Requirements

The minimum requirement by Bscscan API is that your Web server supports PHP 5.6.

## Installation

To install Bscscan PHP API package you can run command:

```
composer require w3spi5/php-bscscan-api:dev-master
```

## Usage

Mainnet

```php
$client = new \Bscscan\Client('Y3U3GMFC8P545CFWRU4TET8MY1K79YDZ3V');
$client->api('account')->balance('0x43406D1baAE11a950DE734DAE4079A3C9Eb48DAf');
```

## For testnet usage

Supported:

-   Testnet

```php
$client = new \Bscscan\Client('Y3U3GMFC8P545CFWRU4TET8MY1K79YDZ3V', BscscanAPIConf::TESTNET);
$client->api('account')->balance('0x43406D1baAE11a950DE734DAE4079A3C9Eb48DAf');
```

## Pull requests are welcome

> This package was adapted from [Maslakou Ihar](https://github.com/maslakoff)'s excellent package called [php-etherscan-api](https://github.com/maslakoff/php-etherscan-api) (that I contributed to). Despite all the care taken, it is possible that there are errors due to the copy of the code. Feel free to submit a pull request if needed.
