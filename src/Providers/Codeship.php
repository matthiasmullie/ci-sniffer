<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @see https://codeship.com/documentation/continuous-integration/set-environment-variables
 *
 * @author Matthias Mullie <ci-environment@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class Codeship implements Environment
{
    /**
     * {@inheritdoc}
     */
    public static function isCurrent()
    {
        return getenv('CI_NAME') === 'codeship';
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider()
    {
        return 'codeship';
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
        // only GitHub & BitBucket are supported; both will have repo urls that
        // include the project slug in this format
        $url = $this->getRepo();
        preg_match('/([^:\/]+\/[^:\/]+?)(\.git|$)/', $url, $matches);

        return $matches[1];
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch()
    {
        return getenv('CI_BRANCH');
    }

    /**
     * {@inheritdoc}
     */
    public function getPullRequest()
    {
        $pr = getenv('CI_PULL_REQUEST');
        return $pr !== 'false' ? $pr : '';
    }

    /**
     * {@inheritdoc}
     */
    public function getCommit()
    {
        return getenv('CI_COMMIT_ID');
    }

    /**
     * {@inheritdoc}
     */
    public function getBuild()
    {
        return getenv('CI_BUILD_NUMBER');
    }
}
