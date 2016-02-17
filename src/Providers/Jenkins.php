<?php

namespace MatthiasMullie\CI\Providers;

use MatthiasMullie\CI\Environment;

/**
 * @see https://wiki.jenkins-ci.org/display/JENKINS/Building+a+software+project#Buildingasoftwareproject-JenkinsSetEnvironmentVariables
 * @see https://wiki.jenkins-ci.org/display/JENKINS/GitHub+pull+request+builder+plugin#GitHubpullrequestbuilderplugin-EnvironmentVariables
 *
 * @author Matthias Mullie <ci-sniffer@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class Jenkins implements Environment
{
    /**
     * {@inheritdoc}
     */
    public static function isCurrent()
    {
        return getenv('JENKINS_URL') !== false;
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider()
    {
        return 'jenkins';
    }

    /**
     * {@inheritdoc}
     */
    public function getRepo()
    {
        return getenv('GIT_URL');
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
        return getenv('ghprbSourceBranch') ?: getenv('GIT_BRANCH') ?: getenv('CVS_BRANCH');
    }

    /**
     * {@inheritdoc}
     */
    public function getPullRequest()
    {
        return getenv('ghprbPullId');
    }

    /**
     * {@inheritdoc}
     */
    public function getCommit()
    {
        return getenv('ghprbActualCommit') ?: getenv('GIT_COMMIT');
    }

    /**
     * {@inheritdoc}
     */
    public function getBuild()
    {
        return getenv('BUILD_NUMBER');
    }
}
