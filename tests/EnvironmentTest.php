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
        $this->assertContains('matthiasmullie/ci-sniffer', $this->environment->getRepo());

        if ($this->isGitRepo()) {
            $none = new None();
            $this->assertEquals($none->getRepo(), $this->environment->getRepo());
        }
    }

    public function testGetSlug()
    {
        $this->assertEquals('matthiasmullie/ci-sniffer', $this->environment->getSlug());
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

    public function testGetAuthor()
    {
        if (!$this->isGitRepo()) {
            $this->markTestSkipped("No git repo, can't compare.");
        }

        $none = new None();
        $this->assertEquals($none->getAuthor(), $this->environment->getAuthor());
    }

    public function testGetAuthorEmail()
    {
        $this->assertContains('@', $this->environment->getAuthorEmail());

        if (!$this->isGitRepo()) {
            $this->markTestSkipped("No git repo, can't compare.");
        }

        $none = new None();
        $this->assertEquals($none->getAuthorEmail(), $this->environment->getAuthorEmail());
    }

    public function testGetTimestamp()
    {
        $this->assertContains('T', $this->environment->getTimestamp());

        if (!$this->isGitRepo()) {
            $this->markTestSkipped("No git repo, can't compare.");
        }

        $none = new None();
        $this->assertEquals($none->getTimestamp(), $this->environment->getTimestamp());
    }

    public function testNoBranchAndPullRequest()
    {
        $branch = $this->environment->getBranch();
        $pr = $this->environment->getPullRequest();

        $this->assertTrue($branch !== '' || $pr !== '', 'Branch or PR must be set.');
        $this->assertFalse($branch !== '' && $pr !== '', 'Only branch or PR can be set.');
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
