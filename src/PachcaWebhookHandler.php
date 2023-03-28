<?php

namespace DocentBF\LaravelPachcaLogger;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class PachcaWebhookHandler extends AbstractProcessingHandler
{
    /**
     * @var string
     */
    private $webhookUrl;
    /**
     * @var PachcaRecord
     */
    private $pachcaRecord;

    /**
     * @param string $webhookUrl
     * @param $level
     * @param bool $bubble
     */
    public function __construct(
        string $webhookUrl,
               $level = Logger::DEBUG,
        bool   $bubble = true
    )
    {
        $this->webhookUrl = $webhookUrl;
        $this->pachcaRecord = new PachcaRecord();

        parent::__construct($level, $bubble);
    }

    /**
     * @param array $record
     * @return void
     */
    protected function write(array $record): void
    {
        $postData = $this->pachcaRecord->generateMessage($record);
        $postString = json_encode($postData);
        $ch = curl_init();

        $options = [
            CURLOPT_URL            => $this->webhookUrl,
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => ['Content-type: application/json'],
            CURLOPT_POSTFIELDS     => $postString,
        ];
        curl_setopt_array($ch, $options);
        curl_exec($ch);
    }
}