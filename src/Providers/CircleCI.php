<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @see https://circleci.com/docs/environment-variables
 *
 * @author Matthias Mullie <ci-sniffer@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class CircleCI extends None implements Environment
{
    /**
     * {@inheritdoc}
     */
    public static function isCurrent()
    {
        return getenv('CIRCLECI') === 'true';
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider()
    {
        return 'circle';
    }

    /**
     * {@inheritdoc}
     */
    public function getRepo()
    {
        return 'git@github.com:'.getenv('CIRCLE_PROJECT_USERNAME').'/'.getenv('CIRCLE_PROJECT_REPONAME').'.git';
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return getenv('CIRCLE_PROJECT_USERNAME').'/'.getenv('CIRCLE_PROJECT_REPONAME');
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch()
    {
        return $this->getPullRequest() === '' ? getenv('CIRCLE_BRANCH') : '';
    }

    /**
     * {@inheritdoc}
     */
    public function getPullRequest()
    {
        return getenv('CIRCLE_PR_NUMBER') ?: '';
    }

    /**
     * {@inheritdoc}
     */
    public function getCommit()
    {
        return getenv('CIRCLE_SHA1');
    }

    /**
     * {@inheritdoc}
     */
    public function getBuild()
    {
        return getenv('CIRCLE_BUILD_NUM');
    }
}
