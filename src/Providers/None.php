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

        exec('git branch', $branches);
        $branches = implode("\n", $branches);
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

        // also fetch pull request refs
        exec('git config --add remote.origin.fetch "+refs/pull/*/head:refs/remotes/origin/pr/*"');
        exec('git fetch origin');

        // now find the PR with the current commit in there
        $refs = shell_exec('git show-ref');
        $commit = preg_quote($this->getCommit(), '/');
        preg_match("/^$commit refs\\/remotes\\/origin\\/pr\\/(.+)$/m", $refs, $match);

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
    public function getBuild()
    {
        return '';
    }

    /**
     * @return bool
     */
    protected function isGitRepo()
    {
        exec('git status', $output, $status);

        return $status === 0;
    }
}
