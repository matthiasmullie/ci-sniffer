<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @author Matthias Mullie <ci-environment@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class None implements Environment
{
    /**
     * {@inheritdoc}
     */
    public static function isCurrent()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider()
    {
        return 'none';
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
    public function getBranch()
    {
        exec('git branch', $branches);
        $branches = implode("\n", $branches);
        preg_match('/^\* (.+)$/m', $branches, $branch);

        return isset($branch) ? $branch[1] : '';
    }

    /**
     * {@inheritdoc}
     */
    public function getCommit()
    {
        return exec('git log --pretty=format:"%H" -1');
    }

    /**
     * {@inheritdoc}
     */
    public function getBuild()
    {
        return '';
    }
}
