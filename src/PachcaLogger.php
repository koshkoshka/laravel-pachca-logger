<?php

namespace DocentBF\LaravelPachcaLogger;

use Monolog\Logger;

class PachcaLogger
{
    /**
     * @param array $config
     * @return Logger
     */
    public function __invoke(array $config): Logger
    {
        $logger = new Logger('pachca');
        $logger->pushHandler(new PachcaWebhookHandler(
                $config['webhookUrl'],
                $config['level']
            )
        );

        return $logger;
    }
}