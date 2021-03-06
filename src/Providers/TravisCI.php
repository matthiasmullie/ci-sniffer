<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @see https://docs.travis-ci.com/user/environment-variables
 *
 * @author Matthias Mullie <ci-sniffer@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class TravisCI extends None implements Environment
{
    /**
     * {@inheritdoc}
     */
    public static function isCurrent()
    {
        return getenv('TRAVIS') === 'true';
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider()
    {
        return 'travis';
    }

    /**
     * {@inheritdoc}
     */
    public function getRepo()
    {
        return 'https://github.com/'.getenv('TRAVIS_REPO_SLUG').'.git';
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return getenv('TRAVIS_REPO_SLUG');
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch()
    {
        return $this->getPullRequest() === '' ? getenv('TRAVIS_BRANCH') : '';
    }

    /**
     * {@inheritdoc}
     */
    public function getPullRequest()
    {
        $pr = getenv('TRAVIS_PULL_REQUEST');

        return $pr !== 'false' ? $pr : '';
    }

    /**
     * {@inheritdoc}
     */
    public function getCommit()
    {
        return getenv('TRAVIS_COMMIT');
    }

    /**
     * {@inheritdoc}
     */
    public function getBuild()
    {
        return getenv('TRAVIS_JOB_NUMBER');
    }
}
