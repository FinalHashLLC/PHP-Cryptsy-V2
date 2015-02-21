CryptsyAPI PHP
===========

PHP wrapper for [Cryptsy.com](https://www.cryptsy.com/) for use with the [Cryptsy.com API](https://www.cryptsy.com/pages/api). Simple abstraction layer on top of existing API interfaces, and automatic JSON decoding on response.

Pull requests accepted and encouraged. :)

### Usage

First, sign up for an account at [Cryptsy.com](https://www.cryptsy.com/) and request an API key under Account > Settings

Download and include the crypstyapi.php class:

~~~
require_once 'path/to/cryptsyapi.php';
~~~

Instantiate the class and set your API key and API Secret.

~~~
$apiKeys = array('key' => 'API_KEY_HERE', 'secret' => 'API_SECRET_HERE');

$api = new \CryptoExpert\CryptsyAPIv2($apiKeys);
