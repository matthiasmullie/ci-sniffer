<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @see https://docs.snap-ci.com/environment-variables
 *
 * @author Matthias Mullie <ci-sniffer@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class SnapCI extends None implements Environment
{
    /**
     * {@inheritdoc}
     */
    public static function isCurrent()
    {
        return getenv('SNAP_CI') === 'true';
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider()
    {
        return 'snap';
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch()
    {
        return getenv('SNAP_BRANCH') ?: '';
    }

    /**
     * {@inheritdoc}
     */
    public function getPullRequest()
    {
        return getenv('SNAP_PULL_REQUEST_NUMBER') ?: '';
    }

    /**
     * {@inheritdoc}
     */
    public function getCommit()
    {
        return getenv('SNAP_COMMIT');
    }

    /**
     * {@inheritdoc}
     */
    public function getBuild()
    {
        return getenv('SNAP_PIPELINE_COUNTER');
    }
}
