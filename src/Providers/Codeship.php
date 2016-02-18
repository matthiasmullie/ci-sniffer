<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @see https://codeship.com/documentation/continuous-integration/set-environment-variables
 *
 * @author Matthias Mullie <ci-sniffer@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class Codeship extends None implements Environment
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
    public function getBranch()
    {
        return $this->getPullRequest() === '' ? getenv('CI_BRANCH') : '';
    }

    /**
     * @todo Just guessing here: building from PRs from forked repos is not yet
     * possible, so we'll have to see what it looks like in the future.
     *
     * @see https://github.com/codeship/documentation/issues/250
     *
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
