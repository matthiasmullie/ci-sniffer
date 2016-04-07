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
    public function getAuthor()
    {
        return getenv('APPVEYOR_REPO_COMMIT_AUTHOR');
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthorEmail()
    {
        return getenv('APPVEYOR_REPO_COMMIT_AUTHOR_EMAIL');
    }

    /**
     * Appveyor has a APPVEYOR_REPO_COMMIT_TIMESTAMP, but it contains this:
     * Expected:                       2016-02-18T16:18:39+01:00
     * APPVEYOR_REPO_COMMIT_TIMESTAMP: 2016-02-18T15:18:39.0000000Z
     * Note how it converted the time to UTC (and has some weird formatting
     * where it adds decimal fraction to the minutes...)
     * I decided against using APPVEYOR_REPO_COMMIT_TIMESTAMP and just using
     * what git gives us and only keep it around as fallback (though it should
     * never be used).
     *
     * {@inheritdoc}
     */
    public function getTimestamp()
    {
        return parent::getTimestamp() ?: getenv('APPVEYOR_REPO_COMMIT_TIMESTAMP');
    }

    /**
     * {@inheritdoc}
     */
    public function getBuild()
    {
        return getenv('APPVEYOR_BUILD_NUMBER');
    }
}
