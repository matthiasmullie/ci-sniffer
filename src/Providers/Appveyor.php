<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @see http://www.appveyor.com/docs/environment-variables
 *
 * @author Matthias Mullie <ci-sniffer@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class Appveyor extends None implements Environment
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
    public function getSlug()
    {
        return getenv('APPVEYOR_REPO_NAME');
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch()
    {
        return $this->getPullRequest() === '' ? getenv('APPVEYOR_REPO_BRANCH') : '';
    }

    /**
     * {@inheritdoc}
     */
    public function getPullRequest()
    {
        return getenv('APPVEYOR_PULL_REQUEST_NUMBER') ?: '';
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
