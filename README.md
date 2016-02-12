# ci-environment

[![Code quality](http://img.shields.io/scrutinizer/g/matthiasmullie/ci-environment.svg)](https://scrutinizer-ci.com/g/matthiasmullie/ci-environment)
[![Latest version](http://img.shields.io/packagist/v/matthiasmullie/ci-environment.svg)](https://packagist.org/packages/matthiasmullie/ci-environment)
[![Downloads total](http://img.shields.io/packagist/dt/matthiasmullie/ci-environment.svg)](https://packagist.org/packages/matthiasmullie/ci-environment)
[![License](http://img.shields.io/packagist/l/matthiasmullie/ci-environment.svg)](https://github.com/matthiasmullie/ci-environment/blob/master/LICENSE)


## Supported CI providers

Provider | Status
--- | ---
Travis CI | [![](https://api.travis-ci.org/matthiasmullie/ci-environment.svg?branch=master)](https://travis-ci.org/matthiasmullie/ci-environment)
Circle CI | [![](https://img.shields.io/circleci/project/matthiasmullie/ci-environment.svg)](https://circleci.com/gh/matthiasmullie/ci-environment)
Codeship | [![](https://img.shields.io/codeship/d65fa110-b318-0133-2330-0e52fcdb9711/master.svg)](https://codeship.com/projects/133591)
Wercker | [![](https://img.shields.io/wercker/ci/matthiasmullie/ci-environment.svg)](https://app.wercker.com/#applications/56bd9f9a239090c8360c43b5)
Shippable | [![](https://img.shields.io/shippable/56bdaae41895ca447473e35d.svg)](https://app.shippable.com/projects/56bdaae41895ca447473e35d)
Appveyor | [![](https://img.shields.io/appveyor/ci/matthiasmullie/ci-environment.svg)](https://ci.appveyor.com/project/matthiasmullie/ci-environment)
Jenkins | Supported!


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
echo $provider->getCommit();
echo $provider->getBuild();
```


## Installation

Simply add a dependency on matthiasmullie/ci-environment to your composer.json file
if you use [Composer](https://getcomposer.org/) to manage the dependencies of
your project:

```sh
composer require matthiasmullie/ci-environment
```

Although it's recommended to use Composer, you can actually include these files
anyway you want.


## License

ci-environment is [MIT](http://opensource.org/licenses/MIT) licensed.
