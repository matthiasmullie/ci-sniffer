<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @author Matthias Mullie <ci-sniffer@mullie.eu>
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
        if (!$this->isGitRepo()) {
            return '';
        }

        return exec('git config --get remote.origin.url');
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        // when using any of the popular cloud git providers (or anything that's
        // modeled after the same username\project model), the repo name will
        // likely be included in this fashion... at least we can try :)
        $url = $this->getRepo();
        $found = preg_match('/([^:\/]+\/[^:\/]+?)(\.git|$)/', $url, $matches);

        return $found ? $matches[1] : '';
    }

    /**
     * {@inheritdoc}
     */
    public function getBranch()
    {
        if (!$this->isGitRepo()) {
            return '';
        }

        $branches = shell_exec('git branch');
        preg_match('/^\* (.+)$/m', $branches, $branch);

        return isset($branch) ? $branch[1] : '';
    }

    /**
     * {@inheritdoc}
     */
    public function getPullRequest()
    {
        if (!$this->isGitRepo()) {
            return '';
        }

        $head = shell_exec('test -f .git/FETCH_HEAD && cat .git/FETCH_HEAD');
        $commit = preg_quote($this->getCommit(), '/');
        preg_match("/^$commit\\s+'refs\\/pull\\/(.+)\\/head'/m", $head, $match);

        return isset($match[1]) ? $match[1] : '';
    }

    /**
     * {@inheritdoc}
     */
    public function getCommit()
    {
        if (!$this->isGitRepo()) {
            return '';
        }

        return exec('git log --pretty=format:"%H" -1');
    }

    /**
     * {@inheritdoc}
     */
    public function getPreviousCommit()
    {
        if (!$this->isGitRepo()) {
            return '';
        }

        return exec('git log --pretty=format:"%H" -1 --skip=1');
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthor()
    {
        if (!$this->isGitRepo()) {
            return '';
        }

        return exec('git log --pretty=format:"%aN" -1');
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthorEmail()
    {
        if (!$this->isGitRepo()) {
            return '';
        }

        return exec('git log --pretty=format:"%aE" -1');
    }

    /**
     * {@inheritdoc}
     */
    public function getTimestamp()
    {
        if (!$this->isGitRepo()) {
            return '';
        }

        /*
         * Exact ISO 8601 format, only available since August 2014
         * @see https://github.com/git/git/commit/466fb6742d7fb7d3e6994b2d0d8db83a8786ebcf
         */
        $timestamp = exec('git log --pretty=format:"%aI" -1');
        if ($timestamp !== '%aI') {
            return $timestamp;
        }

        /*
         * This is an example of what %ai gives, and what it should look like:
         * Current: 2016-02-18T16:02:46+01:00
         * Correct: 2016-02-18 16:02:46 +0100
         * Close enough. Let's just transform it to how we want it to look...
         */
        $timestamp = exec('git log --pretty=format:"%ai" -1');
        $timestamp = preg_replace('/ /', 'T', $timestamp, 1);
        $timestamp = str_replace(' ', '', $timestamp);
        $timestamp = preg_replace('/([0-5]{2})([0-5]{2})$/', '$1:$2', $timestamp);

        return $timestamp;
    }

    /**
     * {@inheritdoc}
     */
    public function getBuild()
    {
        return '';
    }

    /**
     * @return bool
     */
    protected function isGitRepo()
    {
        exec('git status 2>&1', $output, $status);

        return $status === 0;
    }
}
