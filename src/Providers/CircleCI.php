<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @see https://circleci.com/docs/environment-variables
 * @author Matthias Mullie <ci-environment@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class CircleCI implements Environment
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
        return 'https://github.com/'.getenv('CIRCLE_PROJECT_USERNAME').'/'.getenv('CIRCLE_PROJECT_REPONAME').'.git';
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch()
    {
        return getenv('CIRCLE_BRANCH');
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
