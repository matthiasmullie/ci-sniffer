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
Wercker | [![](https://app.wercker.com/status/59efbc6ee4e16b13df426432000ad86a/s)](https://app.wercker.com/project/bykey/59efbc6ee4e16b13df426432000ad86a)

## Example usage

```php
$factory = new \MatthiasMullie\CI\Factory();
$provider = $factory->getCurrent();

// outputs 'travis', 'circle', ..., depending on what CI server the code is run
echo $provider->getProvider(); // e.g. 'travis'

// outputs data about the thing being tested
echo $provider->getRepo(); // e.g. 'git@github.com:matthiasmullie/ci-sniffer.git'
echo $provider->getSlug(); // e.g. 'matthiasmullie/ci-sniffer'
echo $provider->getBranch(); // e.g. 'master'
echo $provider->getPullRequest(); // e.g. '1'
echo $provider->getCommit(); // e.g. '0ed4fabf7ffa28f149f7940fa3eea4fa81c8bcf4'
echo $provider->getBuild(); // e.g. '1'
```

Or execute the binary (`bin/ci-sniffer`) to get all info in JSON format.


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
