<?php

namespace MatthiasMullie\CI\Tests;

use MatthiasMullie\CI\Factory;
use PHPUnit_Framework_TestCase;

class FactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string[]
     */
    protected static $existing;

    /**
     * Fetch existing environment values, so we can restore them after we've
     * been messing up the environment here...
     */
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $environments = static::environmentProvider();
        foreach ($environments as $data) {
            $value = getenv($data[1]);
            static::$existing[] = $value === false ? $data[1] : "$data[1]=$value";
        }
    }

    /**
     * Restore original environment vars these tests are being run under.
     */
    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();

        foreach (static::$existing as $env) {
            putenv($env);
        }
    }

    /**
     * Clear all environment variables.
     */
    public function setUp()
    {
        parent::setUp();

        /*
         * Deleting environment variables in HHVM is unreliable, so lets skip
         * these tests on HHVN
         * @see https://github.com/facebook/hhvm/issues/2533
         */
        if (strpos(phpversion(), 'hhvm') !== false) {
            $this->markTestSkipped('Deleting environment variables in HHVM is unreliable.');
        }

        $environments = static::environmentProvider();
        foreach ($environments as $data) {
            putenv($data[1]);
        }
    }

    /**
     * @return string[]
     */
    public static function environmentProvider()
    {
        return array(
            array('travis', 'TRAVIS', 'true'),
            array('circle', 'CIRCLECI', 'true'),
            array('jenkins', 'JENKINS_URL', 'http://something.something'),
            array('codeship', 'CI_NAME', 'codeship'),
            array('wercker', 'WERCKER_MAIN_PIPELINE_STARTED', '1399372237'),
            array('none', 'NONE', 'nonexisting-environment'),
        );
    }

    /**
     * @dataProvider environmentProvider
     *
     * @param string $expect
     * @param string $env
     * @param string $value
     */
    public function testGetEnvironments($expect, $env, $value)
    {
        putenv("$env=$value");

        $factory = new Factory();
        $current = $factory->getCurrent();

        $this->assertEquals($expect, $current->getProvider());
    }
}
