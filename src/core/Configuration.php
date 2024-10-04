<?php

namespace app\core;

class Configuration
{
    private array $config;
    function __construct(string $APP_NAME)
    {
        $this->config['APP_NAME'] = $APP_NAME;
    }
    public function getConfig()
    {
        return $this->config;
    }
}
