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
        return $this->getPullRequest() === '' ? getenv('WERCKER_GIT_BRANCH') : '';
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
        $commit = preg_quote($this->getCommit(), '/');

        // don't have permissions to do fetch all PR refs (like in None), but we
        // know Wercker has just fetched this particular PR...
        $head = shell_exec('cat .git/FETCH_HEAD');
        preg_match("/^$commit\\s+'refs\\/pull\\/(.+)\\/head'/m", $head, $match);

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
