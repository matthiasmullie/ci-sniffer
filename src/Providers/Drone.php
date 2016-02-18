<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @see http://docs.drone.io/env.html
 * @see https://github.com/drone/drone/blob/a339b54905465cefe1ffed6eb80b2c7ef7a5c6d8/shared/build/build.go#L477
 *
 * @author Matthias Mullie <ci-sniffer@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class Drone extends None implements Environment
{
    /**
     * {@inheritdoc}
     */
    public static function isCurrent()
    {
        return getenv('DRONE') === 'true';
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider()
    {
        return 'drone';
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch()
    {
        return $this->getPullRequest() === '' ? getenv('DRONE_BRANCH') : '';
    }

    /**
     * {@inheritdoc}
     */
    public function getPullRequest()
    {
        return getenv('DRONE_PR');
    }

    /**
     * {@inheritdoc}
     */
    public function getCommit()
    {
        return getenv('DRONE_COMMIT') ?: getenv('SVN_REVISION');
    }

    /**
     * {@inheritdoc}
     */
    public function getBuild()
    {
        return getenv('DRONE_BUILD_NUMBER');
    }
}
