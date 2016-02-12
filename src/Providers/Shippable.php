<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @see http://docs.shippable.com/yml_reference/#standard-environment-variables
 *
 * @author Matthias Mullie <ci-environment@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class Shippable implements Environment
{
    /**
     * {@inheritdoc}
     */
    public static function isCurrent()
    {
        return getenv('SHIPPABLE') === 'true';
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider()
    {
        return 'shippable';
    }

    /**
     * {@inheritdoc}
     */
    public function getRepo()
    {
        return getenv('REPOSITORY_URL');
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch()
    {
        return getenv('BRANCH');
    }

    /**
     * {@inheritdoc}
     */
    public function getCommit()
    {
        return getenv('COMMIT');
    }

    /**
     * {@inheritdoc}
     */
    public function getBuild()
    {
        return getenv('BUILD_NUMBER');
    }
}
