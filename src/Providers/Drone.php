<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @see http://docs.drone.io/env.html
 *
 * @author Matthias Mullie <ci-environment@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class Drone implements Environment
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
    public function getRepo()
    {
        return exec('git config --get remote.origin.url');
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        // when using any of the popular cloud git providers (or anything that's
        // modeled after the same username\project model), the repo name will
        // likely be included in this fashion... at least we can try :)
        $url = $this->getRepo();
        preg_match('/([^:\/]+\/[^:\/]+?)(\.git|$)/', $url, $matches);

        return $matches[1];
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch()
    {
        return getenv('DRONE_BRANCH');
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