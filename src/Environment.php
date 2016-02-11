<?php

namespace MatthiasMullie\CI;

/**
 * @author Matthias Mullie <ci-environment@mullie.eu>
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
     * Name of the git branch being tested.
     *
     * @return string
     */
    public function getBranch();

    /**
     * Hash of the commit being tested.
     *
     * @return string
     */
    public function getCommit();

    /**
     * Build number.
     *
     * @return string
     */
    public function getBuild();
}
