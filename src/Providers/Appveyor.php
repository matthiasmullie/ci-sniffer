<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @see http://www.appveyor.com/docs/environment-variables
 *
 * @author Matthias Mullie <ci-environment@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class Appveyor implements Environment
{
    /**
     * {@inheritdoc}
     */
    public static function isCurrent()
    {
        return getenv('APPVEYOR') === 'True';
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider()
    {
        return 'appveyor';
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
        return getenv('APPVEYOR_REPO_NAME');
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch()
    {
        return getenv('APPVEYOR_REPO_BRANCH');
    }

    /**
     * {@inheritdoc}
     */
    public function getCommit()
    {
        return getenv('APPVEYOR_REPO_COMMIT');
    }

    /**
     * {@inheritdoc}
     */
    public function getBuild()
    {
        return getenv('APPVEYOR_BUILD_NUMBER');
    }
}
