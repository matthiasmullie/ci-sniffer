<?php

namespace MatthiasMullie\CI;

/**
 * @author Matthias Mullie <ci-sniffer@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
interface Environment
{
    /**
     * Checks if this is the current environment.
     *
     * @return bool
     */
    public static function isCurrent();

    /**
     * Name of the CI provider (e.g. travis, circle, ...).
     *
     * @return string
     */
    public function getProvider();

    /**
     * URL of the repository being tested.
     *
     * @return string
     */
    public function getRepo();

    /**
     * Slug of the repository being tested.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Name of the git branch being tested (or empty if in pull request).
     *
     * @return string
     */
    public function getBranch();

    /**
     * Number of the pull request (or empty string if no pull request).
     *
     * @return string
     */
    public function getPullRequest();

    /**
     * Hash of the commit being tested.
     *
     * @return string
     */
    public function getCommit();

    /**
     * Hash of the commit prior to the one being tested.
     * Could be useful for anyone logging test runs to know if all commits have
     * been tested or not: in case multiple commits are pushed at once, only the
     * last commit is tested & the previous commit id will not match the last
     * one that was logged.
     *
     * @return string
     */
    public function getPreviousCommit();

    /**
     * Commit author name.
     *
     * @return string
     */
    public function getAuthor();

    /**
     * Commit author email address.
     *
     * @return string
     */
    public function getAuthorEmail();

    /**
     * Date when the commit was applied (= committer date, not author date), in
     * ISO 8601 format (e.g. 2016-02-18T15:42:27+01:00).
     *
     * @return string
     */
    public function getTimestamp();

    /**
     * Build number.
     *
     * @return string
     */
    public function getBuild();
}
