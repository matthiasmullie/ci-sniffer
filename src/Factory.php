<?php

namespace MatthiasMullie\CI;

use MatthiasMullie\CI\Providers\None;

/**
 * @author Matthias Mullie <ci-environment@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved.
 * @license LICENSE MIT
 */
class Factory
{
    /**
     * @return Environment
     */
    public function getCurrent()
    {
        $providers = $this->getAllProviders();
        foreach ($providers as $provider) {
            $class = "\\MatthiasMullie\\CI\\Providers\\$provider";
            if ($class::isCurrent()) {
                return new $class();
            }
        }

        return new None();
    }

    /**
     * @return string[]
     */
    protected function getAllProviders()
    {
        $files = glob(__DIR__.'/Providers/*.php');

        // since we're PSR-4, just stripping .php from the filename = classnames
        return array_map(function ($file) {
            return basename($file, '.php');
        }, $files);
    }
}
