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
    public function getSlug()
    {
        return getenv('WERCKER_GIT_OWNER').'/'.getenv('WERCKER_GIT_REPOSITORY');
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch()
    {
        return getenv('WERCKER_GIT_BRANCH');
    }

    /**
     * @todo Current code is a workaround until Wercker adds an environment
     * variable to fetch it.
     *
     * @see https://github.com/wercker/support/issues/19
     *
     * {@inheritdoc}
     */
    public function getPullRequest()
    {
        $output = shell_exec('git branch -v');
        var_dump($output);
        $output = shell_exec('git remote -v');
        var_dump($output);
        $output = shell_exec('git reflog');
        var_dump($output);
        $output = shell_exec('git show-ref');
        var_dump($output);
        preg_match('/^git fetch origin \+refs\/pull\/(.+?)\/head\/:$/m', $output, $match);

        return isset($match[1]) ? $match[1] : '';
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
