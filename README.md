# CI sniffer

[![Code quality](http://img.shields.io/scrutinizer/g/matthiasmullie/ci-sniffer.svg)](https://scrutinizer-ci.com/g/matthiasmullie/ci-sniffer)
[![Latest version](http://img.shields.io/packagist/v/matthiasmullie/ci-sniffer.svg)](https://packagist.org/packages/matthiasmullie/ci-sniffer)
[![Downloads total](http://img.shields.io/packagist/dt/matthiasmullie/ci-sniffer.svg)](https://packagist.org/packages/matthiasmullie/ci-sniffer)
[![License](http://img.shields.io/packagist/l/matthiasmullie/ci-sniffer.svg)](https://github.com/matthiasmullie/ci-sniffer/blob/master/LICENSE)


## Travis, is that you?

All CI providers set some environment variables to let you know who they are and
some additional info, but there's little consistency between how and what they
expose. This will figure out what environment you're in and how to access some
(sometimes hard to get) data in there, so you don't have to.


## Supported CI providers

Provider | Status
--- | ---
Appveyor | [![](https://ci.appveyor.com/api/projects/status/w770kc3jqcnhl0jt?svg=true)](https://ci.appveyor.com/project/matthiasmullie/ci-sniffer)
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
echo $provider->getRepo(); // e.g. 'https://github.com/matthiasmullie/ci-sniffer.git'
echo $provider->getSlug(); // e.g. 'matthiasmullie/ci-sniffer'
echo $provider->getBranch(); // e.g. 'master' (or '', when testing PR)
echo $provider->getPullRequest(); // e.g. '1' (or '', when not testing PR)
echo $provider->getCommit(); // e.g. '01081a9c908717bf315f992b814a36c7c9ba7e65'
echo $provider->getAuthor(); // e.g. 'Matthias Mullie'
echo $provider->getAuthorEmail(); // e.g. 'ci-sniffer@mullie.eu'
echo $provider->getBuild(); // e.g. '62.1'
```

Or execute the binary (`bin/ci-sniffer`) to get all info in JSON format. E.g.:

```json
{
    "provider":"travis",
    "repo":"https:\/\/github.com\/matthiasmullie\/ci-sniffer.git",
    "slug":"matthiasmullie\/ci-sniffer",
    "branch":"master",
    "pr":"",
    "commit":"01081a9c908717bf315f992b814a36c7c9ba7e65",
    "author":"Matthias Mullie",
    "author-email":"ci-sniffer@mullie.eu",
    "build":"62.1"
}
```


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
