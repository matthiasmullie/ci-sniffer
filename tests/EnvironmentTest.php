<?php

namespace MatthiasMullie\CI\Tests;

use MatthiasMullie\CI\Environment;
use MatthiasMullie\CI\Factory;
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

    /**
     * There isn't much we can test in terms of actual responses: whatever
     * environment we run it on, with every single commit, ... things will
     * change. Repo, however, should remain the same. So let's check if we find
     * a valid result there, then we at least know the environment detection
     * works & repo can be retrieved correctly.
     */
    public function testGetRepo()
    {
        $this->assertContains('matthiasmullie/ci-environment', $this->environment->getRepo());
    }
}
