<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @see http://devcenter.wercker.com/docs/environment-variables/available-env-vars.html
 *
 * @author Matthias Mullie <ci-environment@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class Wercker implements Environment
{
    /**
     * {@inheritdoc}
     */
    public static function isCurrent()
    {
        return getenv('WERCKER_MAIN_PIPELINE_STARTED') !== false;
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider()
    {
        return 'wercker';
    }

    /**
     * {@inheritdoc}
     */
    public function getRepo()
    {
        return 'git@'.getenv('WERCKER_GIT_DOMAIN').':'.getenv('WERCKER_GIT_OWNER').'/'.getenv('WERCKER_GIT_REPOSITORY').'.git';
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch()
    {
        return getenv('WERCKER_GIT_BRANCH');
    }

    /**
     * {@inheritdoc}
     */
    public function getCommit()
    {
        return getenv('WERCKER_GIT_COMMIT');
    }

    /**
     * {@inheritdoc}
     */
    public function getBuild()
    {
        return getenv('WERCKER_MAIN_PIPELINE_STARTED');
    }
}
