# ci-sniffer

[![Code quality](http://img.shields.io/scrutinizer/g/matthiasmullie/ci-sniffer.svg)](https://scrutinizer-ci.com/g/matthiasmullie/ci-sniffer)
[![Latest version](http://img.shields.io/packagist/v/matthiasmullie/ci-sniffer.svg)](https://packagist.org/packages/matthiasmullie/ci-sniffer)
[![Downloads total](http://img.shields.io/packagist/dt/matthiasmullie/ci-sniffer.svg)](https://packagist.org/packages/matthiasmullie/ci-sniffer)
[![License](http://img.shields.io/packagist/l/matthiasmullie/ci-sniffer.svg)](https://github.com/matthiasmullie/ci-sniffer/blob/master/LICENSE)


## Supported CI providers

Provider | Status
--- | ---
Appveyor | [![](https://ci.appveyor.com/api/projects/status/c4x14o1v81bgodv0?svg=true)](https://ci.appveyor.com/project/matthiasmullie/ci-sniffer)
Circle CI | [![](https://circleci.com/gh/matthiasmullie/ci-sniffer.svg?style=svg)](https://circleci.com/gh/matthiasmullie/ci-sniffer)
Codeship | [![](https://codeship.com/projects/d65fa110-b318-0133-2330-0e52fcdb9711/status?branch=master)](https://codeship.com/projects/133591)
Drone | [![](https://drone.io/github.com/matthiasmullie/ci-sniffer/status.png)](https://drone.io/github.com/matthiasmullie/ci-sniffer)
Jenkins | Supported!
Shippable | [![](https://api.shippable.com/projects/56bdaae41895ca447473e35d/badge/master)](https://app.shippable.com/projects/56bdaae41895ca447473e35d)
Snap CI | [![](https://snap-ci.com/matthiasmullie/ci-sniffer/branch/master/build_image)](https://snap-ci.com/matthiasmullie/ci-sniffer)
Travis CI | [![](https://api.travis-ci.org/matthiasmullie/ci-sniffer.svg?branch=master)](https://travis-ci.org/matthiasmullie/ci-sniffer)
Wercker | [![](https://app.wercker.com/status/28ed29f990ed347f218680c4d08369c8/s)](https://app.wercker.com/project/bykey/28ed29f990ed347f218680c4d08369c8)


## Example usage

```php
$factory = new \MatthiasMullie\CI\Factory();
$provider = $factory->getCurrent();

// outputs 'travis', 'circle', ..., depending on what CI server the code is run
echo $provider->getProvider();

// outputs data about the thing being tested
echo $provider->getRepo();
echo $provider->getSlug();
echo $provider->getBranch();
echo $provider->getPullRequest();
echo $provider->getCommit();
echo $provider->getBuild();
```

Or call the binary (`bin/ci-sniffer`) to get all info in JSON format.


## Installation

Simply add a dependency on matthiasmullie/ci-sniffer to your composer.json file
if you use [Composer](https://getcomposer.org/) to manage the dependencies of
your project:

```sh
composer require matthiasmullie/ci-sniffer
```

Although it's recommended to use Composer, you can actually include these files
anyway you want.


## License

ci-sniffer is [MIT](http://opensource.org/licenses/MIT) licensed.
