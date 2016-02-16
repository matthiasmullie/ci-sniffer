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

    public function testNotNone()
    {
        $msg = 'Asserts a provider is found. Fails on local machine.';
        $this->assertNotEquals('none', $this->environment->getProvider(), $msg);
    }

    public function testGetRepo()
    {
        $this->assertContains('matthiasmullie/ci-environment', $this->environment->getRepo());

        if ($this->isGitRepo()) {
            $none = new None();
            $this->assertEquals($none->getRepo(), $this->environment->getRepo());
        }
    }

    public function testGetSlug()
    {
        $this->assertEquals('matthiasmullie/ci-environment', $this->environment->getSlug());
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
