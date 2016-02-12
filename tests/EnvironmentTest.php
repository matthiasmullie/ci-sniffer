<?php

namespace MatthiasMullie\CI\Tests;

use MatthiasMullie\CI\Environment;
use MatthiasMullie\CI\Factory;
use MatthiasMullie\CI\Providers\None;
use PHPUnit_Framework_TestCase;

class EnvironmentTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Environment
     */
    protected $environment;

    public function setUp()
    {
        parent::setUp();

        $factory = new Factory();
        $this->environment = $factory->getCurrent();
    }

    public function testGetRepo()
    {
        /*
         * There isn't much we can test in terms of actual responses: whatever
         * environment we run it on, with every single commit, ... things will
         * change. Repo, however, should remain the same. So let's check if we
         * find a valid result there, then we at least know the environment
         * detection works & repo can be retrieved correctly.
         */
        $this->assertContains('matthiasmullie/ci-environment', $this->environment->getRepo());

        if ($this->isGitRepo()) {
            $none = new None();
            $this->assertEquals($none->getRepo(), $this->environment->getRepo());
        }
    }

    // branch can't be compared reliably: I can't fetch if by checking the git
    // repo's active branch, because some (e.g. travis, codeship) checkout the
    // specific commit, detached from any branch

    public function testGetCommit()
    {
        if (!$this->isGitRepo()) {
            $this->markTestSkipped("No git repo, can't compare.");
        }

        $none = new None();
        $this->assertEquals($none->getCommit(), $this->environment->getCommit());
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
