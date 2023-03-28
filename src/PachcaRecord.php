<?php

namespace DocentBF\LaravelPachcaLogger;

class PachcaRecord
{
    /**
     * @param array $record
     * @return array
     */
    public function generateMessage(array $record): array
    {
        $dataArray = [];

        $message = $record['message'];

        if ($this->hasException($record)) {
            $exception = $record['context']['exception'];
            $message = $message
                . "\nat: ```" . $exception->getFile() . ":" . $exception->getLine() . "```"
                . "\nstacktrace: \n" . "```\n" . $exception->getTraceAsString() . "\n```\n";
        }

        $dataArray['message'] = $message;

        return $dataArray;
    }

    /**
     * @param array $record
     * @return bool
     */
    private function hasException(array $record): bool
    {
        return is_subclass_of($record['context']['exception'] ?? '', \Throwable::class);
    }
}